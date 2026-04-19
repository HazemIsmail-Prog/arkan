<flux:modal name="attachment-form-modal" variant="flyout" x-on:close="$store.attachments.resetForm()">
    <form @submit.prevent="$store.attachments.submitForm" class="space-y-6" x-bind:disabled="$store.attachments.submitting">
        <template x-if="$store.attachments.form.id">
            <div>
                <flux:heading size="lg">{{ __('Update Attachment') }}</flux:heading>
            </div>
        </template>
        <template x-if="!$store.attachments.form.id">
            <div>
                <flux:heading size="lg">{{ __('Create Attachment') }}</flux:heading>
            </div>
        </template>
        <flux:input id="fileInput" x-on:change="$store.attachments.handleFileSelect" type="file" />
        <flux:input x-model="$store.attachments.form.description_en" label="{{ __('Description (English)') }}" />
        <flux:input x-model="$store.attachments.form.description_ar" label="{{ __('Description (Arabic)') }}" />
        <div class="flex gap-2">
            <flux:input x-model="$store.attachments.form.expires_at" label="{{ __('Expiration Date') }}" type="date" />
            <flux:input x-model="$store.attachments.form.notify_before" label="{{ __('Notify Before') }}" type="number" />
        </div>

        <flux:field variant="inline">
                        <flux:switch
                        x-bind:checked="$store.attachments.form.is_confidential"
                        x-on:change="(event) => { 
                            if(event.target.checked) 
                            { 
                                $store.attachments.form.is_confidential = 1; 
                            } else { 
                                $store.attachments.form.is_confidential = 0; 
                            }
                        }" />
                        <flux:label>{{ __('Confidential') }}</flux:label>
                    </flux:field>
        
        <div class="flex justify-end">
            <flux:button type="submit" variant="primary" x-bind:disabled="$store.attachments.submitting">{{ __('Save') }}</flux:button>
        </div>
    </form>
</flux:modal>