<!-- modal -->
<flux:modal name="form-modal" variant="flyout" x-on:close="form = getEmptyForm()">
    <form @submit.prevent="submitForm" class="space-y-6" x-bind:disabled="submitting">
        <template x-if="form.id">
            <flux:heading size="lg">{{__('Update Equipment')}}</flux:heading>
        </template>
        <template x-if="!form.id">
            <flux:heading size="lg">{{__('Create Equipment')}}</flux:heading>
        </template>
        <flux:input x-model="form.name" label="{{__('Name')}}" />
        <flux:input x-model="form.type" label="{{__('Type')}}" />
        <flux:input x-model="form.location" list="location-datalist" label="{{ __('Location') }}" />
        <datalist id="location-datalist">
            <option value="on_site" />
            <option value="off_site" />
        </datalist>
        <div class="flex">
            <flux:spacer />
            <flux:button type="submit" variant="primary">{{__('Save')}}</flux:button>
        </div>
    </form>
</flux:modal>