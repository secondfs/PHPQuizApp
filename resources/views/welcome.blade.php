<x-layout>
    <div class="d-flex align-items-center justify-content-center">
        <button type="submit" id="startQuiz" class="mt-5 d-flex btn btn-primary border-success align-items-center btn-success"> Start <i class="fa fa-angle-right ml-2"></button>
    </div>

    <x-forms.nickname-form></x-forms.nickname-form>
    @push('appJs')
        <link rel="stylesheet" href="/app.css">
        <script src="/app.js" defer></script>
    @endpush
</x-layout>

