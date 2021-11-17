<form method="post" action="/send-mail">
    @csrf
    <label for="email">Email</label>
    <input type="email" id="email" name="email">
    <button type="submit">Send</button>
</form>
