<div>
    <form action="/quiz/run"
          method="POST"
          name="nickname">
        @csrf

        <input type="text"
               name="nickname"
               value="{{ old('nickname') }}"
        >
        <button type="submit" id="pushNickname"> Submit </button>
        @error('nickname')
            <div class="alert alert-danger">
                <span> {{ $message }}</span>
            </div>
        @enderror
    </form>
</div>
