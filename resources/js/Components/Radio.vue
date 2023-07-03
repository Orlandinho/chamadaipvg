<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        required: true,
    },
    value: {
        default: null,
    },
});

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
    <fieldset>
        <div class="space-y-4 sm:flex sm:items-center sm:space-x-10 sm:space-y-0">
            <div class='flex items-center' v-for='(gender, index) in value' :key='index'>
                <input :id='value' name='items' type='radio' v-model='proxyChecked' :value='value'
                       class='h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600' />
                <label :for='value' class='ml-3 block text-sm font-medium leading-6 text-gray-900'>{{ value }}</label>
            </div>
        </div>
    </fieldset>
</template>
