<x-layouts.app :title="__('Required Approvals')">

    <div x-data="requiredApprovalsComponent">

        <!-- modals -->
        @include('modals.approval-form')

        <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

            <!-- header -->
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-semibold">{{__('Required Approvals')}} <span class="text-gray-500 text-xs" x-text="total"></span></h2>
                @if(auth()->user()->hasPermissionTo('create_requiredapproval'))
                    <flux:button variant="primary" @click="showCreateFormModal">
                        {{ __('Create Required Approval') }}
                    </flux:button>
                @endif
            </div>

            <!-- required approvals table -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Authority') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-if="requiredApprovals.length === 0">
                            <tr>
                                <td colspan="2" class="text-center text-gray-400 py-8">
                                    {{ __('No required approvals found.') }}
                                </td>
                            </tr>
                        </template>
                        <template x-for="requiredApproval in requiredApprovals" :key="requiredApproval.id">
                            <tr>
                                <td x-text="requiredApproval.title"></td>
                                <td x-text="requiredApproval.authority"></td>
                                <td x-text="requiredApproval.status"></td>
                                <td>
                                    <div class="flex gap-2 justify-end items-center">
                                        <template x-if="requiredApproval.can_update">
                                            <flux:icon.pencil-square class="size-4 text-blue-500 dark:text-blue-300" x-on:click="showEditFormModal(requiredApproval)" />
                                        </template>
                                        <template x-if="requiredApproval.can_delete">
                                            <flux:icon.trash 
                                                    class="size-4 text-red-500 dark:text-red-300" 
                                                    x-on:click="deleteRequiredApproval(requiredApproval)" 
                                                    x-bind:class="{ 'opacity-50 pointer-events-none': deleting === requiredApproval.id }" 
                                                />
                                        </template>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            <!-- load more button -->
            <div class="flex justify-end mt-4">
                <flux:button
                    variant="outline"
                    @click="loadMore"
                    x-bind:disabled="current_page === last_page"
                    x-show="current_page < last_page"
                >
                    {{ __('Load More') }}
                </flux:button>
            </div>

        </div>

    </div>

</x-layouts.app>