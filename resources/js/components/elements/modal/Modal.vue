<template>
    <div class="modal fade" v-bind:id="type" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-xl modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-center d-block border border-info">
                    <h5 class="modal-title d-inline-block font-weight-bold" id="modal-title">
                        {{ action }} un produit
                    </h5>
                </div>

                <form @submit.prevent="submit">
                    <div class="modal-body">
                        <form-field
                            label="ID"
                            type="text"
                            disabled
                            v-if="type == 'edit'"
                            v-model="fields.id"
                            v-bind:errors="errors"
                            v-bind:post="post"
                            v-on:change="change"
                        >
                        </form-field>

                        <form-field
                            v-for="(formField, index) in formFields"
                            :key="index"
                            v-bind:label="formField.label"
                            v-bind:type="formField.type"
                            v-bind:data="formField.data"
                            v-model="fields[formField.name]"
                            v-bind:errors="errors"
                            v-bind:error-field="errors[formField.name]"
                            v-bind:post="post"
                            v-on:change="change"
                        >
                        </form-field>
                    </div>

                    <div class="modal-footer text-center d-block">
                        <button type="button" class="btn btn-primary text-body" data-dismiss="modal">
                            Annuler
                        </button>

                        <button type="submit" class="btn btn-success text-body" v-bind:disabled="uneditable">
                            {{ action }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script src="./modal.js"></script>
