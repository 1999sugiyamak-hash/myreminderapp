package com.example.myreminderapp

import android.Manifest
import android.annotation.SuppressLint
import android.app.Notification
import android.app.NotificationChannel
import android.app.NotificationManager
import android.app.Service;
import android.content.Intent
import android.content.pm.PackageManager
import android.os.Build
import android.os.IBinder
import android.os.Looper
import androidx.camera.camera2.pipe.core.Log
import androidx.core.app.ActivityCompat
import androidx.core.app.NotificationCompat
import com.google.android.gms.location.*;

class LocationService : Service(){
// Init API to get current location
    private lateinit var fusedLoationClient: FusedLocationProviderClient
// Build API
    private val locationRequest = (
        LocationRequest.Builder(
            Priority.PRIORITY_HIGH_ACCURACY,
            3_000
        )
            .setMinUpdateIntervalMillis(1_000)
            .build()
    )

// Send current location to laravel
    private val locationCallback = object : LocationCallback() {
        override fun onLocationResult(result: LocationResult) {
            for (location in result.locations){
                val latitude = location.latitude
                val longitude = location.longitude
//                Log.d(
//                    "LocationService",
//                    "現在地取得: latitude=${latitude}, longitude=${longitude}"
//                )
                println("Location: $latitude, $longitude")

                sendLocationToLaravel(
                    latitude,longitude
                )
            }
        }
    }

    override fun onCreate() {
        super.onCreate()

//        Create channel to send notifications
        createNotificationChannel()

//        Send notifications to confirm if users allow to share their locations
        startForeground(
            1,
            createNotification()
        )

        // Execute API to get location
        fusedLoationClient = LocationServices.getFusedLocationProviderClient(this)

        startLocationUpdates()
    }

    private fun createNotificationChannel(){
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.O){
            val channel = NotificationChannel(
            "location",
            "current location",
            NotificationManager.IMPORTANCE_LOW
        )

        val manager = getSystemService(
            NotificationManager::class.java
        )

        manager.createNotificationChannel(channel)
    }
}

    private fun createNotification(): Notification{
        return NotificationCompat.Builder(
            this,
            "location"
        )
            .setContentTitle("Getting location")
            .setSmallIcon(
                android.R.drawable.ic_menu_mylocation
            )
            .build()
    }

    @SuppressLint("MissingPermission")
    private fun startLocationUpdates(){

        // Get details of clients location
        val fineLocation = ActivityCompat.checkSelfPermission(
            this,
            Manifest.permission.ACCESS_FINE_LOCATION
        )

        // Get about clients location
        val coarseLocation = ActivityCompat.checkSelfPermission(
            this,
            Manifest.permission.ACCESS_COARSE_LOCATION
        )

        if(fineLocation != PackageManager.PERMISSION_GRANTED && coarseLocation != PackageManager.PERMISSION_GRANTED){
            return
        }

        fusedLoationClient.requestLocationUpdates(
            locationRequest,
            locationCallback,
            Looper.getMainLooper()
        )
    }

    private fun sendLocationToLaravel(latitude: Double, longitude: Double){
    Thread{
        try{
            val url = java.net.URL(
//                Mock implement
                "https://cedar-ons-having-cut.trycloudflare.com/api/location"
            )

            val connection = url.openConnection() as java.net.HttpURLConnection
            connection.requestMethod = "POST"
            connection.setRequestProperty(
                "Content-Type",
                "application/json"
            )

            connection.doOutput = true

            val json = """
                {
                    "latitude": $latitude,
                    "longitude": $longitude
                    }
            """.trimIndent()

            connection.outputStream.use{
                it.write(json.toByteArray())
            }

            println(json)
            println("Laravel response: ${connection.responseCode}")

            connection.disconnect()
        } catch(e: Exception){
            e.printStackTrace()
        }
    }.start()
    }
    override fun onBind(intent: Intent?): IBinder? {
        return null
    }
}
