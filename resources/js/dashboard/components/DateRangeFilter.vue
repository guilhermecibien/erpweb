<template>
    <div class="btn-group pull-right" data-toggle="buttons">
        <label
            v-for="option in options"
            :key="option.key"
            class="btn btn-info"
            :class="{ active: modelValue === option.key }"
        >
            <input
                type="radio"
                name="date-filter"
                :checked="modelValue === option.key"
                @change="$emit('update:modelValue', option.key)"
            >
            {{ option.label }}
        </label>
    </div>
</template>

<script>
export default {
    name: 'DateRangeFilter',
    props: {
        modelValue: { type: String, required: true },
        options: { type: Array, required: true },
    },
    emits: ['update:modelValue'],
};
</script>
