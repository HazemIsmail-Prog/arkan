document.addEventListener('alpine:init', () => {
    Alpine.data('equipmentComponent', () => ({
        equipment: [],
        current_page:1,
        last_page:1,
        per_page:100,
        total:0,
        form:{},
        submitting: false,
        deleting: null,
        init() {
            this.fetchEquipment();
        },
        getEmptyForm() {
            return {
                name: '',
                type: '',
                status: '',
            }
        },
        fetchEquipment() {
            axios.get(`/equipment?page=${this.current_page}&per_page=${this.per_page}`)
                .then(response => {
                    this.equipment = [...this.equipment, ...response.data.data];
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
            this.fetchEquipment();
        },
        showEditFormModal(equipment) {
            this.form = {...equipment};
            Flux.modal('form-modal').show()
        },
        showCreateFormModal() {
            this.form = this.getEmptyForm();
            Flux.modal('form-modal').show()
        },

        submitForm() {
            if (this.form.id) {
                this.updateEquipment();
            } else {
                this.storeEquipment();
            }
        },
        storeEquipment() {
            this.submitting = true;
            axios.post('/equipment', this.form)
                .then(response => {
                    this.equipment.unshift(response.data);
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
        updateEquipment() {
            this.submitting = true;
            axios.put(`/equipment/${this.form.id}`, this.form)
                .then(response => {
                    this.equipment = this.equipment.map(equipment => equipment.id === this.form.id ? response.data : equipment);
                    Flux.modal('form-modal').close();
                })
                .catch(error => {
                    console.error(error);
                })
                .finally(() => {
                    this.submitting = false;
                });
        },
        deleteEquipment(equipment) {
            if(!confirm('Are you sure you want to delete this equipment?')) {
                return;
            }
            this.deleting = equipment.id;
            axios.delete(`/equipment/${equipment.id}`)
                .then(response => {
                    this.equipment = this.equipment.filter(e => e.id !== equipment.id);
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