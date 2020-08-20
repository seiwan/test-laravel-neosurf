<template>
    <div>
        <div class="alert alert-success" role="alert" v-show="success.status">
            {{ success.message }}

            <button type="button" class="close" aria-label="Close" v-on:click="closeAlert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="card border-secondary">
            <div class="card-header bg-info">Produits</div>

            <div class="card-body">
                <div class="row add-item mb-4">
                    <div class="col-6 text-left">
                        <div v-show="products && products.length != 0">
                            <button type="button" class="btn btn-primary text-body" v-bind:disabled="disabledPreviousPage" v-on:click="load(pages.current - 1)">
                                Précédent
                            </button>

                            <select class="align-middle">
                                <option v-for="(page, index) in pages.data" :key="index" :selected="pages.current == page" v-on:click="load(page)">
                                    Page {{ page }}
                                </option>
                            </select>

                            <button type="button" class="btn btn-primary text-body" v-bind:disabled="disabledNextPage" v-on:click="load(pages.current + 1)">
                                Suivant
                            </button>
                        </div>
                    </div>

                    <div class="col-6 text-right">
                        <button type="button" class="btn btn-success text-body" data-toggle="modal" data-target="#add" v-on:click="clear">
                            <i class="fas fa-plus-circle"></i>

                            Ajouter un produit
                        </button>
                    </div>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td v-for="(column, index) in columns" :key="index" v-bind:class="column.size">
                                {{ column.name }}
                            </td>
                        </tr>
                    </thead>

                    <tbody v-if="products && products.length != 0">
                        <tr v-for="product in products" :key="product.id">
                            <td class="col-2 align-middle">
                                {{ product.id }}
                            </td>

                            <td class="col-3 align-middle">
                                {{ product.name }}
                            </td>

                            <td class="col-3 align-middle">
                                {{ product.category }}
                            </td>

                            <td class="col-2 align-middle">
                                {{ product.quantity }}
                            </td>

                            <td class="col-2 align-middle">
                                <button type="button" class="btn btn-sm btn-primary text-body" data-toggle="modal" data-target="#edit" v-on:click="get(product.id)">
                                    <i class="fas fa-pen"></i>
                                </button>

                                <button type="button" class="btn btn-sm btn-danger text-body" v-on:click="remove(product.id)">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>

                    <tbody v-else>
                        <tr>
                            <td v-bind:colspan="5">
                                Aucun produit à afficher
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="text-left">
                    Affichage des produits {{ first }} à {{ last }} sur {{ total }} produits
                </div>
            </div>
        </div>

        <!-- Add modal -->
        <modal ref="addModal" type="add" v-bind:values="product" v-bind:current-page="pages.current" v-on:reload="load"></modal>

        <!-- Edit modal -->
        <modal type="edit" v-bind:values="product" v-bind:current-page="pages.current" v-on:reload="load"></modal>
    </div>
</template>

<script src="./products.js"></script>
