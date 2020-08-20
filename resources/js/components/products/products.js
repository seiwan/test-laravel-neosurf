export default {
    data() {
        return {
            success: {
                status: false
            },
            columns: [
                {
                    name: "#",
                    size: "col-1"
                },
                {
                    name: "Nom",
                    size: "col-3"
                },
                {
                    name: "Catégorie",
                    size: "col-3"
                },
                {
                    name: "Quantité",
                    size: "col-3"
                },
                {
                    name: "Actions",
                    size: "col-2"
                }
            ],
            pages: {},
            first: null,
            last: null,
            total: null,
            products: {},
            product: {}
        }
    },
    computed: {
        disabledPreviousPage() {
            if (this.pages.previous) {
                return false;
            }

            return true;
        },
        disabledNextPage() {
            if (this.pages.next) {
                return false;
            }

            return true;
        }
    },
    methods: {
        load(page, success) {
            if (!page) {
                page = 1;
            }

            axios.get('/api/products?page=' + page).then( (response) => {
                var pages = [];

                for (var page = 1; page <= response.data.last_page; page++) {
                    pages.push(page);
                }

                this.pages = {
                    current: response.data.current_page,
                    previous: response.data.prev_page_url,
                    next: response.data.next_page_url,
                    last: response.data.last_page,
                    data: pages
                },
                this.first = response.data.from;
                this.last = response.data.to;
                this.total = response.data.total;
                this.products = response.data.data;
            });

            if (success) {
                this.success = success;
                var self = this;

                setTimeout(function() { self.success = {}; }, 5000);
            }
        },
        get(product) {
            axios.get('/api/products/' + product).then( (response) => {
                this.product = response.data;
            });
        },
        remove(product) {
            axios.delete('/api/products/remove/' + product).then( (response) => {
                this.load(this.pages.current);
            });
        },
        clear() {
            this.product = {};
            this.$refs.addModal.errors = {};
            this.$refs.addModal.post = false;
        },
        closeAlert() {
            this.success = {};
        }
    },
    created() {
        this.load();
    }
}
