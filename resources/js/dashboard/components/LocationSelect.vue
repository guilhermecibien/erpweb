<template>
    <select
        id="dashboard_location"
        class="form-control"
        :value="modelValue"
        @change="$emit('update:modelValue', $event.target.value)"
    >
        <option value="">{{ placeholder }}</option>
        <option v-for="(name, id) in locations" :key="id" :value="id">{{ name }}</option>
    </select>
</template>

<script>
export default {
    name: 'LocationSelect',
    props: {
        modelValue: { type: [String, Number], default: '' },
        locations: { type: Object, required: true },
        placeholder: { type: String, default: '' },
    },
    emits: ['update:modelValue'],
};
</script>
