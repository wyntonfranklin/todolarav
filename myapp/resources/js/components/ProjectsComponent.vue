<template>
    <div class="h-auto">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Project Dashboard</h3>
                    <p class="mt-1 text-sm text-gray-600">Start your new project here.</p>
                    <div class="shadow sm:overflow-hidden sm:rounded-md mt-3">
                        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                            <form ref="projectForm" id="project-form" action="/projects" method="POST">

                                <label class="block text-sm font-medium text-gray-700">Project Title</label>
                                <input type="text" name="title" class="border-solid form-input block w-full flex-1 border-2 rounded:sm mb-3 text-base p-3"/>


                                <label class="block text-sm font-medium text-gray-700">Project Description</label>
                                <textarea type="text" name="description" class="border-solid form-input block w-full flex-1 border-2 rounded:sm mb-3 text-base p-3"></textarea>


                                <label class="block text-sm font-medium text-gray-700">Project Start Date</label>
                                <input type="date" name="startdate" class="border-solid form-input block w-full flex-1 border-2 rounded:sm mb-3 text-base p-3"/>

                                <label class="block text-sm font-medium text-gray-700">Project Status</label>
                                <select name="status" class="border-solid form-input block w-full flex-1 border-2 rounded:sm mb-3 text-base p-3">
                                    <option value="Not Started">Not started</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Closed">Closed</option>
                                </select>

                                <label class="block text-sm font-medium text-gray-700">Project Owner</label>
                                <select name="owner" class="border-solid form-input block w-full flex-1 border-2 rounded:sm mb-3 text-base p-3">
                                   <!-- vue loop array --->
                                    <option v-for="employee in employees" :value="employee.firstName + ' ' + employee.lastName">
                                        {{ employee.firstName + ' ' + employee.lastName }}</option>
                                </select>

                                <label class="block text-sm font-medium text-gray-700">Project Color</label>
                                <select name="color" class="border-solid form-input block w-full flex-1 border-2 rounded:sm mb-3 text-base p-3">
                                    <option value="green">Green</option>
                                    <option value="red">Red</option>
                                    <option value="blue">Blue</option>
                                    <option value="yellow">Yellow</option>
                                </select>
                                <button @click.prevent='this.submitForm' type="submit" class="mr-5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Submit
                                </button>
                                <button @click.prevent="this.clearForm" class="bg-neutral-300 text-white font-bold py-2 px-4 rounded">Clear form</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0">
                <!-- validation error -->
                <div class="shadow sm:overflow-hidden sm:rounded-md">
                    <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                        <h2><i class="fa fa-home"></i> &nbsp;Current Projects Listing</h2>
                        <!-- error message -->
                        <div v-if="errors.length" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Whoops! </strong>
                            <span class="block sm:inline">There were some problems with your input.</span>
                            <ul class="list-disc list-inside">
                                <li v-for="error in errors" class="text-sm">{{ error }}</li>
                            </ul>
                        </div>
                        <!-- success message -->
                        <div v-if="this.success.length >0" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Success! </strong>
                            <span class="block sm:inline">{{ this.success }}</span>
                        </div>
                        <div class="min-h-full">
                            <div v-for="project in projects" class="p-3 bg-slate-200 flex mb-3 bg-slate-200">
                                <div class="flex-none mr-1" >
                                    <div :class="this.getColorClass(project.color)" class="w-16 h-16 bg-lime-800"/>
                                </div>
                                <div class="flex-auto">
                                    <div class="flex flex-wrap">
                                        <h1 class="block w-full">{{ project.title }}</h1>
                                        <p class="block w-full">{{ project.description }}</p>
                                        <p class="text-sm">
                                            <i class="fa fa-calendar"></i> {{ project.startdate }}&nbsp;
                                            <i class="fa fa-user"></i> {{ project.owner }} &nbsp;
                                            <i class="fa fa-check"></i> {{ project.status }}
                                        </p>
                                    </div>
                                </div>
                                <div class="float-right"><a href="#" @click.prevent="this.removeProjects(project.id)"><i class="fa fa-trash-o"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6 h-10"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

</template>

<script>
export default {
    name: "ProjectsComponent",
    // get from api
    data() {
         return {
             employees: [],
             projects : [],
             errors: [],
             success: "",
         }
     },
     mounted() {
         this.getEmployees();
         this.getProjects();
     },
     methods: {
        getColorClass(color){
            if(color == 'green'){
                return 'bg-lime-800';
            }else if(color == 'red'){
                return 'bg-red-800';
            }else if(color == 'blue'){
                return 'bg-blue-800';
            }else if(color == 'yellow'){
                return 'bg-yellow-800';
            }
        },
         getEmployees() {
             axios.get('/api/employees')
                 .then(response => {
                     this.employees = response.data;
                 })
                 .catch(error => {
                     console.log(error);
                 });
         },
         getProjects() {
             axios.get('/api/projects')
                 .then(response => {
                     this.projects = response.data;
                 })
                 .catch(error => {
                     console.log(error);
                 });
         },
         // get form data
        submitForm() {
            let formData = new FormData(document.getElementById('project-form'));
            axios.post('/api/projects', formData)
                .then(response => {
                //    console.log("test",response);
                    this.getProjects();
                    this.clearForm();
                })
                .catch(error => {
              //      this.errors = response.data.errors;
                    console.log(error.response.data.errors);
                   // this.errors = error.response.data.errors;
                    //loop through errors
                    for (let key in error.response.data.errors) {
                        this.errors.push(error.response.data.errors[key][0]);
                    }
                });
        },
         clearForm(){
             this.$refs.projectForm.reset();
             this.errors = [];
         },
         // delete axios request
         removeProjects(id){
             let con = confirm("Are you sure you want to delete this project?");
             if (con == true){
                 // axios delete request
                 axios.delete('/api/projects/' + id)
                     .then(response => {
                         // get success message
                         console.log(response.data.message)
                      this.success = response.data.message;
                        this.getProjects();
                     })
                     .catch(error => {
                         console.log(error);
                     });
             }
         }
     }

}
</script>

<style scoped>

</style>
