document.addEventListener('alpine:init', () => {
    Alpine.data('projectSettingsComponent', () => ({
        form:{},
        submitting: false,

        init() {
            this.form = this.getEmptyForm();
            this.fetchSetting();
        },

        getEmptyForm() {
            return {
                project_start_date: '',
                project_end_date: '',
                work_progress: '',
                attachments: [],
            };
        },
        fetchSetting() {
            axios.get("/project-settings")
                .then(response => {
                    this.form = {...response.data};
                })
                .catch(error => {
                    console.error(error);
                });
        },

        handleAttachmentsChangedEvent() {
            const fileInput = this.$refs.fileInput;
            if (fileInput) fileInput.value = null;
            
            this.fetchSetting();
        },

        submitForm() {
            this.submitting = true;
            axios.put("/project-settings", this.form)
                .then(response => {
                    this.form = {...response.data};
                })
                .catch(error => {
                    console.error(error);
                })
                .finally(() => {
                    this.submitting = false;
                });
        },

            
    }))
})