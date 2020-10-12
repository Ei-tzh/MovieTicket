@extends('layouts.master')

@section('content')
   
   
@endsection
@push('jquery')
   
    
@endpush
{{-- @push('vue')
<script>

    window.onload = function () {
       //$('#movietheater').select2();
        var app1= new Vue({
            el: '#app1',
            data: {
                message:'Hello',
                movietheater:0,
                movietheaters:'',
                timetable:0,
                timetables:'',
                movies:'',
                theaters:''
               
            },
        
            methods:{
                    getmovietheaters:function(){
                        axios.get('/api/getmovietheaters')
                    .then(function (response) {
                        this.movietheaters = response.data;
                    }.bind(this));
                },
                gettimetables:function(){
                    axios.get('/api/gettimetables',{
                        params: {
                            id: this.movietheater
                        }
                    })
                    .then(function(response){
                        this.timetables = response.data;
                    }.bind(this));
                },
                getmovies:function(){
                    axios.get('/api/getmovies')
                    .then(function(response){
                        this.movies = response.data;
                    }.bind(this));
                },
                getTheaters:function(){
                    axios.get('/api/gettheaters')
                    .then(function(response){
                        this.theaters = response.data;
                    }.bind(this));
                },
                movienames:function(value){
                    for(var i=0;i<this.movies.length;i++){
                        if(this.movies[i].id==value){
                            return this.movies[i].name
                        }
                    }
                },
                theaters_cinema:function(value){
                    for(var i=0;i<this.theaters.length;i++){
                        if(this.theaters[i].id==value){
                            var theater= this.theaters[i].name
                            var cinema=this.theaters[i].cinema.name
                            return (theater.concat('( ',cinema,' )'))
                        }
                    }
                }

               
            },
            created: function(){
                this.getmovietheaters(),
                this.getmovies(),
                this.getTheaters()
            }
        })
    }
    
</script>
@endpush --}}
