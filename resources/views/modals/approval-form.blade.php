<!-- modal -->
<flux:modal name="form-modal" variant="flyout" x-on:close="form = getEmptyForm()">
    <form @submit.prevent="submitForm" class="space-y-6" x-bind:disabled="submitting">
        <template x-if="form.id">
            <flux:heading size="lg">{{__('Update Required Approval')}}</flux:heading>
        </template>
        <template x-if="!form.id">
            <flux:heading size="lg">{{__('Create Required Approval')}}</flux:heading>
        </template>
        <flux:input x-model="form.title" label="{{__('Title')}}" />
        <flux:input x-model="form.authority" label="{{__('Authority')}}" />
        <flux:input x-model="form.status" label="{{__('Status')}}" />
        <div class="flex">
            <flux:spacer />
            <flux:button type="submit" variant="primary">{{__('Save')}}</flux:button>
        </div>
    </form>
</flux:modal>