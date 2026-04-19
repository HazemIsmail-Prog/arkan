document.addEventListener('alpine:init', () => {
    Alpine.data('requiredApprovalsComponent', () => ({
        requiredApprovals: [],
        current_page:1,
        last_page:1,
        per_page:100,
        total:0,
        form:{},
        submitting: false,
        deleting: null,
        init() {
            this.fetchRequiredApprovals();
        },
        getEmptyForm() {
            return {
                title: '',
                authority: '',
                status: '',
            }
        },
        fetchRequiredApprovals() {
            axios.get(`/required-approvals?page=${this.current_page}&per_page=${this.per_page}`)
                .then(response => {
                    this.requiredApprovals = [...this.requiredApprovals, ...response.data.data];
                    this.current_page = response.data.current_page;
                    this.last_page = response.data.last_page;
                    this.per_page = response.data.per_page;
                    this.total = response.data.total;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        loadMore() {
            this.current_page++;
            this.fetchRequiredApprovals();
        },
        showEditFormModal(requiredApproval) {
            this.form = {...requiredApproval};
            Flux.modal('form-modal').show()
        },
        showCreateFormModal() {
            this.form = this.getEmptyForm();
            Flux.modal('form-modal').show()
        },

        submitForm() {
            if (this.form.id) {
                this.updateRequiredApproval();
            } else {
                this.storeRequiredApproval();
            }
        },
        storeRequiredApproval() {
            this.submitting = true;
            axios.post('/required-approvals', this.form)
                .then(response => {
                    this.requiredApprovals.unshift(response.data);
                    Flux.modal('form-modal').close();
                    this.total++;
                })
                .catch(error => {
                    console.error(error);
                })
                .finally(() => {
                    this.submitting = false;
                });
        },
        updateRequiredApproval() {
            this.submitting = true;
            axios.put(`/required-approvals/${this.form.id}`, this.form)
                .then(response => {
                    this.requiredApprovals = this.requiredApprovals.map(requiredApproval => requiredApproval.id === this.form.id ? response.data : requiredApproval);
                    Flux.modal('form-modal').close();
                })
                .catch(error => {
                    console.error(error);
                })
                .finally(() => {
                    this.submitting = false;
                });
        },
        deleteRequiredApproval(requiredApproval) {
            if(!confirm('Are you sure you want to delete this required approval?')) {
                return;
            }
            this.deleting = requiredApproval.id;
            axios.delete(`/required-approvals/${requiredApproval.id}`)
                .then(response => {
                    this.requiredApprovals = this.requiredApprovals.filter(r => r.id !== requiredApproval.id);
                    this.total--;
                })
                .catch(error => {
                    console.error(error);
                })
                .finally(() => {
                    this.deleting = null;
                });
        }
    }))
})