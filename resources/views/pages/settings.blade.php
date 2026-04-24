<x-layouts.app :title="__('Project Settings')">

    <div 
        x-data="projectSettingsComponent()"
        x-on:attachment-updated.window="handleAttachmentsChangedEvent"
        x-on:attachment-added.window="handleAttachmentsChangedEvent"
        x-on:attachment-deleted.window="handleAttachmentsChangedEvent"
    >

        <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

            <!-- header -->
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-semibold">{{ __('Project Settings') }}</h2>
            </div>

            <form @submit.prevent="submitForm" class="space-y-6" x-bind:disabled="submitting">
                <flux:input type="date" x-model="form.project_start_date" label="{{__('Project Start Date')}}" required />
                <flux:input type="date" x-model="form.project_end_date" label="{{__('Project End Date')}}" required />
                <flux:input type="number" step="0.1" min="0" max="100" x-model="form.work_progress" label="{{__('Work Progress')}}" required />
                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" variant="primary">{{__('Save')}}</flux:button>
                </div>
            </form>

            <div 
                x-data
                x-init="
                    $store.attachments.form.attachable_id = 1;
                    $store.attachments.form.attachable_type = 'setting';
                "
            >
                <form @submit.prevent="$store.attachments.submitForm" class="space-y-6" x-bind:disabled="$store.attachments.submitting">
                    <template x-if="!$store.attachments.form.id">
                        <div>
                            <flux:heading size="lg">{{ __('Project Images') }}</flux:heading>
                        </div>
                    </template>
                    <div class="flex items-center justify-between">
                        <flux:input id="fileInput" x-on:change="$store.attachments.handleFileSelect" type="file" />                
                        <flux:button type="submit" variant="primary" x-bind:disabled="$store.attachments.submitting">{{ __('Upload') }}</flux:button>
                    </div>
                </form>
            </div>

            <template x-if="form.attachments && form.attachments.length > 0">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <template x-for="attachment in form.attachments" :key="attachment.id">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 flex flex-col items-center">
                            <img 
                                :src="attachment.view_url" 
                                alt="{{__('Project Image')}}" 
                                class="w-full h-36 object-cover rounded mb-3"
                            />
                            <div class="flex justify-end w-full">
                                <flux:icon.trash 
                                    class="size-5 text-red-500 dark:text-red-300 hover:text-red-700 cursor-pointer" 
                                    x-on:click="$store.attachments.deleteAttachment(attachment)" 
                                />
                            </div>
                        </div>
                    </template>
                </div>
            </template>

        </div>

    </div>

</x-layouts.app>