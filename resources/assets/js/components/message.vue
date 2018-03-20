<template>
    <li class="list-group-item" :class="className">
        <slot></slot>
        <small class="badge float-right" :color="badgeClass">You</small>
    </li>
</template>

<script>
    export default {
        props: [
            'color'
        ],
        computed: {
            className(){
                return 'list-group-item-' + this.color;
            },
            badgeClass(){
                return 'badge-' + this.color;
            }
        },
        mounted() {
            console.log('Component mounted.');
        }
    }
</script>
