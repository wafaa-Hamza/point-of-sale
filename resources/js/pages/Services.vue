
<template>
  <div style="margin-block-start: 5%">
    <VCard>
      <VCardText>
        <VRow>
          <VCol
            cols="12"
            sm="6"
            md="5"
          >
            <VTextField
              v-model="search"
              type="text"
              label="Search"
            />
          </VCol>
          <VCol
            cols="12"
            sm="6"
            md="5"
          />
          <VCol
            cols="12"
            sm="6"
            md="2"
          >
            <VDialog
              v-model="dialog"
              width="1024"
              persistent
              z-index="1000"
            >
              <template #activator="{ props }">
                <VBtn v-bind="props">
                  Create New Service
                </VBtn>
              </template>
              <VCard>
                <VCardTitle>
                  <span class="text-h5">services</span>
                </VCardTitle>
               
                <VCardText>
                  <VContainer>
                    <VRow>
                      <VCol
                        cols="12"
                        sm="6"
                        md="4"
                      >
                        <VTextField
                          v-model="name"
                          label="Name"
                        />
                      </VCol>
                      <VCol
                        cols="12"
                        sm="6"
                        md="4"
                      >
                        <VTextField
                          v-model="name_loc"
                          label="Name loc"
                        />
                      </VCol>
                    </VRow>
                  </VContainer>
                </VCardText>
                <VCardActions>
                  <VSpacer />
                  <VBtn
                    color="blue-darken-1"
                    variant="text"
                    @click="dialog = false, errors = null"
                  >
                    Close
                  </VBtn>
                  <VBtn
                    type="submit"
                    color="blue-darken-1"
                    variant="text"
                    @click="addService"
                  >
                    Submit
                  </VBtn>
                </VCardActions>
              </VCard>
            </VDialog>
          </VCol>
        </VRow>
        <br>
        <br>

        <VTable>
          <thead>
            <tr>
              <th>
                Name
              </th>
              <th>
                Name loc
              </th>

              <th>
                Delete
              </th>
              <th>
                Show
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="Services === null">
              <td
                colspan="8"
                style="text-align: center;"
              >
                No data available
              </td>
            </tr>
            <tr
              v-for="item in Services"
              v-else
              :key="item.id"
            >
              <td>{{ item.name }}</td>
              <td>{{ item.name_loc }}</td>

              <td>
                <VBtn
                  color="primary"
                  @click="Delete(item.id)"
                >
                  <VIcon icon="mdi-delete" />
                </VBtn>
              </td>
              <td>
                <VRow>
                  <VDialog
                    v-model="item.dialogVisible"
                    width="1024"
                    persistent
                    z-index="1000"
                  >
                    <template #activator="{ props }">
                      <VBtn
                        v-bind="props"
                        @click="Updates(item)"
                      >
                        <VIcon icon="mdi-eye" />
                      </VBtn>
                    </template>
                    <VCard>
                      <VCardTitle>
                        <span class="text-h5">services</span>
                      </VCardTitle>
                      
                      <VCardText>
                        <VContainer>
                          <VRow>
                            <VCol
                              cols="12"
                              sm="6"
                              md="4"
                            >
                              <VTextField
                                v-model="name_edit"
                                label="Name"
                              />
                            </VCol>
                            <VCol
                              cols="12"
                              sm="6"
                              md="4"
                            >
                              <VTextField
                                v-model="name_loc_edit"
                                label="Name loc"
                              />
                            </VCol>
                          </VRow>
                        </VContainer>
                      </VCardText>
                      <VCardActions>
                        <VSpacer />
                        <VBtn
                          color="blue-darken-1"
                          variant="text"
                          @click="item.dialogVisible = false"
                        >
                          Close
                        </VBtn>
                        <VBtn
                          type="submit"
                          color="blue-darken-1"
                          variant="text"
                          @click=" updateServices(item)"
                        >
                          Update
                        </VBtn>
                        <VBtn
                         
                          color="red"
                          style="background: red;color: white"
                          @click="Delete(item.raw.id)"
                        >
                          <VIcon
                            icon="mdi-delete"
                            style="font-size: 135%"
                          />
                        </VBtn>
                      </VCardActions>
                    </VCard>
                  </VDialog>
                </VRow>
              </td>
            </tr>
          </tbody>
          <br>
        </VTable>
      </VCardText>
    </VCard>
    <VDialog
      v-model="dialog4"
      width="200" 
    >
      <VCard class="text-center">
        one
        <br><br>
        two
        <br><br>
        three
      </VCard>
    </VDialog>
  </div>
</template>

<script>

//import Swal from 'sweetalert2'
import axios from "axios"


export default {
  name: "ServicesTable",

  // eslint-disable-next-line vue/component-api-style
  data() {
    return {
      menusVariant: ['warning'],
      items: [
        {
          title: 'Option 1',
          value: 'Option 1',
        },
        {
          title: 'Option 2',
          value: 'Option 2',
        },
        {
          title: 'Option 3',
          value: 'Option 3',
        },
      ],
      search: '',
      dialog: false,
      dialog3: false,
      Services: [],
      serviceid: '',
      id: '',
      perPage: 10,
      name: '',
      name_loc: '',
      count: 0,

      pagei: [],
      page: 2,
      pageInfo: null,
      totalPages: 4,
      pageSize: 5,

      pageSizes: [5, 10, 15, 20, 25, 30],


      name_edit: '',
      name_loc_edit: '',
      dialogVisible: false,

      URL: window.location.origin,


    }
  },
  // eslint-disable-next-line vue/component-api-style
  mounted() {
    this.getServices()
  },
  async createService() {
    const response = await this.addService({
      name: this.name,
      name_loc: this.name_loc,
       
    })



    if (response.status != undefined) {
      this.alert('Service has been created successfully', true)

      //  this.clear()
      this.dialog = false
    }
  },


  // eslint-disable-next-line vue/component-api-style
  methods: {
    goNext(elem) {
      const currentIndex = Array.from(elem.form.elements).indexOf(elem)

      elem.form.elements.item(
        currentIndex < elem.form.elements.length - 1 ?
          currentIndex + 1 :
          0,
      ).focus()
    },
    getServices() {
      axios
        .get(`${this.URL}/api/general/services`)
        .then(res => {

          this.Services = res.data.data

        })
    },
   

    

    async addService() {

      try {
        const user = await axios.post(
          `${this.URL}/api/general/services`,
          {
            name: this.name,
            name_loc: this.name_loc,
     
          },
        )

        this.name = ''
        this.name_loc = ''
  

        this.dialog = false


        this.getServices()
       
      } catch (e) {
        console.log(e)
      }
    },

    async Delete(GetId) {
      this.serviceid = GetId
      console.log('GetId', GetId)
      console.log('this.serviceid', this.serviceid)
      axios
        .delete(`${this.URL}/api/general/services/${this.serviceid}`)
        .then(response => (this.Services = response.data.data))
      this.getServices()
    },


    deleteData() {

      axios
        .delete(`${this.URL}/api/general/services/${this.serviceid}`)
        .then(response => (this.Services = response.data.data))
      this.getServices()
    },

    async Updates(Getdata) {

      this.serviceid = Getdata
      this.name_edit = Getdata.name
      this.name_loc_edit = Getdata.name_loc
      this.dialogVisible=true

      console.log(Getdata)
    },

    async updateServices() {
      try {
        const user = await axios.put(

          `${this.URL}/api/general/services/${this.serviceid.id}`,
          {


            name: this.name_edit,
            name_loc: this.name_loc_edit,
    

          },

        )

        this.getServices()
        this.dialogVisible = false
      
      } catch (e) {
        console.log(e)
      }

    },




  },
}
</script>
