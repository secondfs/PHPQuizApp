<div>
    <form action="/quiz/run"
          method="POST"
          name="nickname">
        @csrf

        <input type="text"
               name="nickname">
        <button type="submit" id="pushNickname"> Submit </button>
        <button class="btn btn-primary border-success align-items-center btn-success" type="button">Next<i class="fa fa-angle-right ml-2"></i></button>
    </form>
</div>
