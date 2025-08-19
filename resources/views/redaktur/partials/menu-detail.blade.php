<div id="editModal" 
     class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden flex items-center justify-center z-[1000] transition-all duration-300">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-auto overflow-y-auto animate-fade-in-up">
        
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white px-6 py-4 flex items-center justify-between">
            <h2 class="text-lg font-semibold">Menu Properties</h2>
            <button onclick="closeEditModal()" class="text-white hover:text-gray-200 text-sm">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form method="POST" action="" id="formUpdateDetail" class="px-6 py-5 text-sm text-gray-700 space-y-4">
            @csrf
            @method('PUT')
            <input type="hidden" id="editId" name="id" />
            <input type="hidden" id="editParentId" name="parent_id" />
            <input type="hidden" id="editOrderInput" name="order" />

            <div>
                <label class="block font-medium mb-1">Title</label>
                <input type="text" id="editTitle" name="title" class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
            </div>

            <div>
                <label class="block font-medium mb-1">URL</label>
                <input type="text" id="editUrl" name="url" class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
            </div>
            
            <div>
                <label class="block font-medium mb-1">Status</label>
                <input type="hidden" name="status_aktif" value="0">
                <label class="relative inline-flex items-center cursor-pointer mt-2">
                    <input type="checkbox" id="statusCheckbox" name="status_aktif" value="1" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer 
                                 peer-checked:after:translate-x-full peer-checked:after:border-white 
                                 after:content-[''] after:absolute after:top-[2px] after:left-[2px] 
                                 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 
                                 after:transition-all peer-checked:bg-blue-600">
                    </div>
                    
                </label>
            </div>

            <div>
                <label class="block font-medium mb-1">Date Added</label>
                <input type="text" id="editTanggal" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100" readonly />
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    <i class="fas fa-save mr-1"></i> Save
                </button>
            </div>
        </form>
    </div>
</div>