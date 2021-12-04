<div>
    <form action="/quiz/run"
          method="POST"
          name="nickname">
        @csrf

        <input type="text"
               name="nickname">
        <button type="submit" id="pushNickname"> Submit </button>
    </form>
</div>
