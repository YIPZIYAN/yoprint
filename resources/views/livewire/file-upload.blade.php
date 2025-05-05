<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <form wire:submit="save">
        <div wire:loading wire:target="file">Uploading...</div>

        <div class="flex space-x-2">
            <div class="space-x-1 flex-1">
                <input wire:model="file"
                       class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                       id="file_input" type="file">
            </div>

            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Upload
            </button>
        </div>
        @error('file') <span class="text-red-500">{{ $message }}</span> @enderror
    </form>


    <div class="relative overflow-x-auto" >
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Time
                </th>
                <th scope="col" class="px-6 py-3">
                    File Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($fileUploads as $fileUpload)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $fileUpload->created_at }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $fileUpload->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $fileUpload->status }}
                    </td>
                </tr>
            @empty
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <th scope="row" colspan="100%" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        No Data.
                    </th>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
