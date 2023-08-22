<script setup>
import { computed, ref } from 'vue';
import { RadioGroup, RadioGroupLabel, RadioGroupOption } from '@headlessui/vue'

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        required: true,
    },
    value: {
        default: null,
    },
    colors: Object
});

const selectedColor = ref('')

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});

</script>

<template>
    <RadioGroup v-model="selectedColor">
        <RadioGroupLabel class="block font-medium text-sm text-zinc-700">Selecione a cor da classe</RadioGroupLabel>
        <div class="mt-4 flex items-center space-x-3">
            <RadioGroupOption as="template" v-for="color in colors" :key="color.name" :value="color.name" v-slot="{ active, checked }">
                <div :class="[color.ringColor, active && checked ? 'ring ring-offset-1' : '', !active && checked ? 'ring-2' : '', 'relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none']">
                    <RadioGroupLabel as="span" class="sr-only">{{ color.name }}</RadioGroupLabel>
                    <span aria-hidden="true" :class="[color.bgColor, 'h-8 w-8 rounded-full border border-black border-opacity-10']" />
                </div>
            </RadioGroupOption>
        </div>
    </RadioGroup>
</template>
