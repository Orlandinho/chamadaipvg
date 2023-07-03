<script setup>
import { computed, ref, watch } from 'vue'
import {
    CheckCircleIcon,
    ExclamationTriangleIcon,
    InformationCircleIcon,
    XCircleIcon,
} from '@heroicons/vue/24/outline'
import { XMarkIcon } from '@heroicons/vue/20/solid'
import { alert } from '@/DataShare/store.js'

let show = ref(false)

let toast = ref()

watch(
    alert,
    (val) => {
        toast.value = val
        show.value = true
        setTimeout(() => {
            show.value = false
        }, 5000)
    },
    {
        deep: true,
    }
)


const iconType = computed(() => {
    const icons = {
        success: CheckCircleIcon,
        warning: ExclamationTriangleIcon,
        failure: XCircleIcon,
        info: InformationCircleIcon,
    }
    if (toast.value) {
        return icons[toast.value.type]
    }
})

const iconColor = computed(() => {
    const icons = {
        success: 'text-green-500',
        warning: 'text-orange-500',
        failure: 'text-red-500',
        info: 'text-blue-500',
    }

    if (toast.value) {
        return icons[toast.value.type]
    }
})

const titleColor = computed(() => {
    const icons = {
        success: 'text-green-800',
        warning: 'text-orange-800',
        failure: 'text-red-800',
        info: 'text-blue-800',
    }

    if (toast.value) {
        return icons[toast.value.type]
    }
})
</script>

<template>
    <!-- Global notification live region, render this permanently at the end of the document -->
    <div
        aria-live="assertive"
        class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6">
        <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
            <!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->
            <Transition
                enter-active-class="transform ease-out duration-300 transition"
                enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                leave-active-class="transition ease-in duration-300"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0">
                <div
                    v-if="show"
                    class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                    <div class="p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <component
                                    :is="iconType"
                                    :class="iconColor"
                                    aria-hidden="true"
                                    class="h-6 w-6" />
                            </div>
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p
                                    :class="titleColor"
                                    class="text-sm font-medium">
                                    {{ toast.title }}
                                </p>
                                <p class="mt-1 text-sm text-gray-500">
                                    {{ toast.message }}
                                </p>
                            </div>
                            <div class="ml-4 flex flex-shrink-0">
                                <button
                                    class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    type="button"
                                    @click="show = false">
                                    <span class="sr-only">Close</span>
                                    <XMarkIcon
                                        aria-hidden="true"
                                        class="h-5 w-5" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </Transition>
        </div>
    </div>
</template>

