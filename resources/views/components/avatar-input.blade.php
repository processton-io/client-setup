@props(['disabled' => false])

<div class="flex flex-col items-start space-y-2">
    <!-- Avatar Preview -->
    <div class="w-24 h-24 rounded-full overflow-hidden border border-gray-300">
        <img id="avatarPreview" src="/storage/{{ $attributes->get('value') ?? 'default-avatar.png' }}" alt="Avatar Preview" class="w-full h-full object-cover">
    </div>

    <!-- File Input -->
    <input
        type="file"
        name="avatar"
        accept="image/*"
        id="avatarInput"
        @disabled($disabled)
        class="hidden"
        onChange="previewAvatar(event)"
    >
    {{-- @dd($attributes) --}}
    <!-- Label for File Input -->
    <label for="avatarInput" class="cursor-pointer bg-gray-200 hover:bg-gray-300 text-gray-700 py-1 px-3 rounded-md text-sm">
        Select Avatar
    </label>
</div>

<script>
    function previewAvatar(event) {
        const input = event.target;
        const preview = document.getElementById('avatarPreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
