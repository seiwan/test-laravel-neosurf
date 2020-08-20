export default {
    props: ['type', 'values', 'currentPage'],
    data() {
        return {
            formFields: [
                {
                    name: "name",
                    label: "Nom",
                    type: "text"
                },
                {
                    name: "category",
                    label: "Catégorie",
                    type: "text"
                },
                {
                    name: "supplier",
                    label: "Fournisseur",
                    type: "text"
                },
                {
                    name: "description",
                    label: "Description",
                    type: "textarea"
                },
                {
                    name: "price",
                    label: "Prix",
                    type: "text"
                },
                {
                    name: "quantity",
                    label: "Quantité",
                    type: "number"
                }
            ],
            errors: {},
            post: false,
            originalValues: null,
            uneditable: false,
        }
    },
    computed: {
        action() {
            if (this.type == 'add') {
                return 'Ajouter';
            } else if (this.type == 'edit') {
                return 'Modifier';
            }
        },
        method() {
            if (this.type == 'add') {
                return 'post';
            } else if (this.type == 'edit') {
                return 'put';
            }
        },
        route() {
            var route = '/api/products/' + this.type;

            if (this.type == 'edit') {
                route += '/' + this.values.id;
            }

            return route;
        },
        fields: {
            get() {
                if (this.values) {
                    return this.values;
                }

                return {};
            },
            set(values) {
                this.fields = values;
            }
        }
    },
    methods: {
        submit() {
            axios[this.method](this.route, this.fields).then( (response) => {

                if (this.type == 'add') {
                    var action = 'ajouté';
                } else if (this.type == 'edit') {
                    var action = 'modifié';
                }

                var success = {
                    status: true,
                    message: "Le produit \"" + this.fields.name + "\" a été " + action + " avec succès."
                };

                this.$emit('reload', this.currentPage, success);
                $('#' + this.type).modal('hide');
            }).catch( (error) => {
                this.post = true;
                this.errors = error.response.data.errors;
            });
        },
        change(field) {
            this.post = false;
            this.errors[field] = false;
        }
    },
    updated() {
        if ( this.type == 'edit' && ( this.originalValues == null || (this.originalValues && JSON.parse(this.originalValues).id != this.values.id) ) ) {
            this.originalValues = JSON.stringify(this.values);
        }

        if ( this.type == 'edit' && this.originalValues === JSON.stringify(this.values) ) {
            this.uneditable = true;
        } else {
            this.uneditable = false;
        }
    }
}
