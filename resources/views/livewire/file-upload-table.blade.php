<div class="relative overflow-x-auto" wire:poll>
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
