<template>
    <h1>Tutorials</h1>
    <p>Here you can find all the tutorials</p>
    <!-- bootstrap table -->
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Tags</th>
            <th scope="col">Created At</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="tutorial in tutorials" :key="tutorial.id">
            <td>{{ tutorial.title }}</td>
            <td>{{ tutorial.description }}</td>
            <td>{{ tutorial.tags }}</td>
            <td>{{ tutorial.createdOn }}</td>
            <td><button @click="showTutorial(tutorial.id)" class="btn btn-primary btn-sm">view</button></td>
        </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: "TutorialsComponent",
    props: {
        tuts: Array
    },
    data() {
        return {
            tutorials: JSON.parse(this.tuts)
        }
    },
    mounted() {
        console.log('Component mounted.')
        this.getTutorials();
    },
    methods : {
        getTutorials() {
           console.log(this.tutorials);

        },
        showTutorial(id) {
            console.log(id);
        }
    }
}
</script>
