<template>
    <h1>Tutorials</h1>
    <p>Here you can find all the tutorials</p>
    <!-- Boostrap card template card is visible-->
    <div class="card" style="" v-if="cardVisible" >
        <img class="card-img-top" :src="this.currentImage" alt="Card image cap">
        <a @click.prevent="this.showTable()" id="button" class=""><i class="fa fa-times"></i></a>
        <div class="card-body">
            <h5 class="card-title">{{ this.currentTitle }}</h5>
            <p class="card-text">{{  this.currentDescription }}</p>
            <a href="#" @click.prevent="this.showTable()" class="btn btn-primary"><i class="fa fa-arrow-left"></i>&nbsp;Back to list</a>
        </div>
    </div>


    <!-- bootstrap table -->
    <table class="table table-striped" v-if="!cardVisible">
        <thead>
        <tr>
            <th>#</th>
            <th>Preview</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Category</th>
            <th scope="col">Tags</th>
            <th scope="col">Created At</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="tutorial in tutorials" :key="tutorial.id">
            <td>{{ tutorial.id}}</td>
            <td><img alt="" :src="tutorial.featuredImage" style="height: 50px;"/></td>
            <td>{{ tutorial.title }}</td>
            <td>{{ tutorial.description }}</td>
            <td>{{ tutorial.category }}</td>
            <td>{{ tutorial.tags }}</td>
            <td>{{ tutorial.createdOn }}</td>
            <td><button @click="showTutorial(tutorial)" class="btn btn-primary btn-sm">view</button></td>
        </tr>
        </tbody>
    </table>
    <!-- bootstrap pagination -->
    <nav aria-label="Page navigation example" v-if="!cardVisible">
        <ul class="pagination">
            <li class="page-item"><a @click.prevent="this.prevNext('prev')" class="page-link" href="#">Previous</a></li>
            <!-- loop range 1 to total pages -->
            <li :class="{active:this.isCurrentPage(page)}" class="page-item" v-for="page in totalPages" :key="page">
                <a class="page-link" href="#" @click.prevent="this.loadPage(page)">{{ page }}</a>
            </li>
            <li class="page-item"><a @click.prevent="this.prevNext('next')" class="page-link" href="#">Next</a></li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: "ApiComponent",
    props: {

    },
    data() {
        return {
            tutorials: [],
            totalPages : 0,
            currentPage : 1,
            cardVisible: false,
            currentImage: 'https://www.wftutorials.com/uploads/2023/02/wpsy25.png',
            currentTitle: "",
            currentDescription: "",
        }
    },
    mounted() {
        console.log('Component mounted.')
        // axios call to get all tutorials
       this.loadPage(1);
    },
    methods : {
        showTable(){
            this.cardVisible = false;
        },
        getTutorials() {
            console.log(this.tutorials);

        },
        showTutorial(tutorial) {
            this.cardVisible = true;
            this.currentImage = tutorial.featuredImage;
            this.currentTitle = tutorial.title;
            this.currentDescription = tutorial.description;
           // console.log(id);
        },
        prevNext(direction){
            if(direction == "prev" && this.currentPage > 1){
                this.currentPage--;
            }else if(direction == "next" && this.currentPage < this.totalPages){
                this.currentPage++;
            }
            this.loadPage(this.currentPage);
        },
        loadPage(page) {
            this.currentPage = page;
            axios.get('/api/tutorials?page=' + page)
                .then(response => {
                    this.tutorials = response.data.tutorials;
                    this.totalPages = response.data.meta.totalPages;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        isCurrentPage(pg) {
            return (pg === this.currentPage) ? true : false;
        }


    }
}
</script>
<style scoped>
    /* button on far right of container */
    #button {
        text-orientation: upright;
        font-size: 20px;
        margin-top: 1px;
        margin-right: 2px;
        position:absolute;
        top:0;
        color:white;
        right:5px;
    }

</style>
