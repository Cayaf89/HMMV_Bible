<template>
    <div class="w-full mb-3">
        <label :for="id">{{ label }}</label>
        <input :type="type" v-model="value" :placeholder="placeholder" :autocomplete="autocomplete" :id="id"
               class="block w-full px-3 py-1.5 text-base font-normal text-gray-800 bg-gray-100 bg-clip-padding border-0 appearance-none rounded-lg transition-shadow transition-colors"
               :class="{ 'invalid': !valid }">
        <div class="invalid-feedback" v-if="!valid && errorMessages.length > 0">
            <div class="d-flex" v-for="error in errorMessages">
                {{ error }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Input",
    props: {
        modelValue: String,
        id: String,
        type: String,
        label: String,
        placeholder: String,
        autocomplete: String,
        valid: {
            type: Boolean,
            default: true
        },
        errorMessages: Array
    },
    emits: ['update:modelValue'],
    computed: {
        value: {
            get() {
                return this.modelValue
            },
            set(value) {
                this.$emit('update:modelValue', value)
            }
        }
    }
}
</script>
