<!-- The view for creating reminders -->

<h1>Create Reminder</h1>
<form>
    <div>
        <label for="created_user">Name</label>
        <input type="text" id="created_user" required />
    </div>
    <div>
        <label for="title">Reminder title</label>
        <input type="text" id="title" required />
    </div>
    <div>
        <label for="description">Description</label>
        <textarea id="description"></textarea>
    </div>
    <div>
        <label for="user_received_reminder">Name received reminder</label>
        <input type="text" id="user_received_reminder" required />
    </div>
    <div>
        <label for="remind_at">DateTime received reminder</label>
        <input type="datetime-local" id="remind_at" />
    </div>
    <div>
        <input type="submit" value="Create reminder!" />
    </div>
</form>