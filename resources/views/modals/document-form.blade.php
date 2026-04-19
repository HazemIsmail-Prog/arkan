<!-- modal -->
<flux:modal name="form-modal" variant="flyout" x-on:close="form = getEmptyForm()">
    <form @submit.prevent="submitForm" class="space-y-6" x-bind:disabled="submitting">
        <template x-if="form.id">
            <flux:heading size="lg">{{ __('Update Document') }}</flux:heading>
        </template>
        <template x-if="!form.id">
            <flux:heading size="lg">{{ __('Create Document') }}</flux:heading>
        </template>

        <flux:input type="date" x-model="form.date" label="{{ __('Date') }}" />
        <flux:input x-model="form.type" list="type-datalist" label="{{ __('Type') }}" />
        <datalist id="type-datalist">
            <option value="Letter" />
            <option value="Invoice" />
            <option value="Contract" />
        </datalist>
        <flux:input x-model="form.ref" label="{{ __('Ref') }}" />
        <flux:textarea rows="auto" x-model="form.subject" label="{{ __('Subject') }}" />
        <flux:textarea rows="auto" x-model="form.description" label="{{ __('Description') }}" />

        <flux:input x-model="form.sent_from" label="{{ __('Sent From') }}" />
        <flux:input x-model="form.sent_to" label="{{ __('Sent To') }}" />

        <div class="flex">
            <flux:spacer />
            <flux:button type="submit" variant="primary">{{ __('Save') }}</flux:button>
        </div>
    </form>
</flux:modal>