<div>
    <div wire:loading wire:target="file">
       Uploading
    </div>
    <form wire:submit.prevent="save">
        @csrf
        <div class="flex space-x-2">
            <div class="space-x-1 flex-1">
                <input name="csvFile" wire:model="file"
                       class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                       id="csvFile" type="file">
            </div>

            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Upload
            </button>
        </div>
        @error('file') <span class="text-red-500">{{ $message }}</span> @enderror
        @error('hash') <span class="text-red-500">{{ $message }}</span> @enderror
    </form>
</div>
