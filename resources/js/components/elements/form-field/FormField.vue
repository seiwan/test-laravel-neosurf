<template>
    <div class="form-group row">
        <label v-bind:for="name" class="col-form-label col-2 text-right">
            {{ label }}
        </label>

        <div class="col-10">
            <div class="form-row">
                <textarea class="form-control" rows="5" cols="200"
                    v-if="type == 'textarea'"
                    v-bind:id="name"
                    v-bind:name="name"
                    v-bind:value="value"
                    v-on:change="$emit('input', $event.target.value), $emit('change', name)"
                    v-bind:class="{ 'is-invalid': errorField, 'is-valid': post && !errorField }"
                >
                    {{ value }}
                </textarea>

                <input
                    class="form-control"
                    v-else
                    v-bind:type="type"
                    v-bind:id="name"
                    v-bind:name="name"
                    v-bind:value="value"
                    v-on:input="$emit('input', $event.target.value), $emit('change', name)"
                    v-bind:class="{ 'is-invalid': errorField, 'is-valid': post && !errorField }"
                    :disabled="disabled"
                />

                <div class="invalid-feedback text-left font-weight-bold" v-if="errors && errorField">
                    {{ errorField[0] }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['name', 'label', 'type', 'data', 'disabled', 'value', 'errors', 'errorField', 'post']
    }
</script>
