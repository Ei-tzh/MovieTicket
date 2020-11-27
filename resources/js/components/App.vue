<template>
    <date-picker v-model="date" type="date"></date-picker>
</template>
<script>
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
        export default {
            name:"app",
            components:{ 
                'date-picker':DatePicker
                 },
            data() {
                return {
                    date:new Date(),
                    today:''
                };
            },
            methods:{
                currentdate:function(){
                    this.today=this.date.toLocaleDateString()
                    
                }
            },
            created:function(){
                this.currentdate()
            }

            
        };
</script>