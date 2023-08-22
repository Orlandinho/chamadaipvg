<script setup>
import { computed, ref } from 'vue'

const emit = defineEmits(['update:modelValue']);

const props = defineProps({
    modelValue: {
        type: [String, Number],
        required: true,
    },
    classrooms: {
        type: Object,
        required: true
    }
});

const selectedClass = ref(props.modelValue)

</script>

<template>
    <div>
        <label for="classroom" class="block text-sm font-medium leading-6 text-gray-900">Selecione a classe</label>
        <select
            id="classroom"
            name="classroom"
            v-model='selectedClass'
            @input="$emit('update:modelValue', $event.target.value)"
            class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
            <option v-for='classroom in classrooms' :key='classroom.id' :selected='selectedClass === classroom.id' :value="classroom.id">{{ classroom.name }}</option>
        </select>
    </div>
</template>

