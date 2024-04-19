
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
            md="3"
          />
          <VCol
            cols="12"
            sm="6"
            md="4"
          >
            <VDialog
              v-model="dialog"
              width="1024"
              persistent
              z-index="1000"
            >
              <template #activator="{ props }">
                <VBtn v-bind="props">
                  Create New ItemSubCategory
                </VBtn>
              </template>
              <VCard>
                <VCardTitle>
                  <span class="text-h5">itemSubCategories</span>
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
                        <VTextField
                          v-model="color"
                          label="Color"
                        />

                        <VTextField
                          v-model="image"
                          label="Image"
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
                    @click="addItemSubCategory"
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
                Color
              </th>
              <th>
                Image
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
            <tr v-if="ItemSubCategories == null">
              <td
                colspan="8"
                style="text-align: center;"
              >
                No data available
              </td>
            </tr>
            <tr
              v-for="item in ItemSubCategories"
              v-else
              :key="item.id"
            >
              <td>{{ item.name }}</td>
              <td>{{ item.name_loc }}</td>
              <td>{{ item.color }}</td>
              <td>{{ item.image }}</td>



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
                        <span class="text-h5">itemSubCategories</span>
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
                              <VTextField
                                v-model="color_edit"
                                label="Color"
                              />
                              <VTextField
                                v-model="image_edit"
                                label="Image"
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
                          @click="item.dialogVisible = true"
                        >
                          Close
                        </VBtn>
                        <VBtn
                          type="submit"
                          color="blue-darken-1"
                          variant="text"
                          @click=" updateItemSubCategories(item)"
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
  name: "ItemSubCategoriesTable",

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
      ItemSubCategories: [],
      itemSubcategoryid: '',
      id: '',
      perPage: 10,
      category_id: '',
      pos_id: '',
      name: '',
      name_loc: '',
      color: '',
      imaage: '',


      count: 0,

      pagei: [],
      page: 2,
      pageInfo: null,
      totalPages: 4,
      pageSize: 5,

      pageSizes: [5, 10, 15, 20, 25, 30],


      name_edit: '',
      name_loc_edit: '',
      color_edit: '',
      image_edit: '',
      dialogVisible: false,

      URL: window.location.origin,


    }
  },
  // eslint-disable-next-line vue/component-api-style
  mounted() {
    this.getItemSubCategories()
  },

 


  // eslint-disable-next-line vue/component-api-style
  methods: {

    getItemSubCategories() {
      axios
        .get(`${this.URL}/api/item/itemsubcategory`)
        .then(res => {

          this.ItemSubCategories = res.data.data

        })
    },
    async createItemSubCategories() {
      response = await this.addItemSubCategory()
    
      if (response.status != undefined) {
        this.alert('ItemSubCategory has been created successfully', true)

        //  this.clear()
        this.dialog = false
      }
    },
    goNext(elem) {
      const currentIndex = Array.from(elem.form.elements).indexOf(elem)

      elem.form.elements.item(
        currentIndex < elem.form.elements.length - 1 ?
          currentIndex + 1 :
          0,
      ).focus()
    },


   
   

    

    async addItemSubCategory() {

      try {
        const user = await axios.post(
          `${this.URL}/api/item/itemsubcategory`,
          {
          
            pos_id: 1,
            category_id: 1,
            name: this.name,
            name_loc: this.name_loc,
            color: this.color,
            image: this.image,
     
          },
        )

        this.name = ''
        this.name_loc = ''
        this.color = ''
        this.image = ''
  

        this.dialog = false


        this.getItemSubCategories()
       
      } catch (e) {
        console.log(e)
      }
    },

    async Delete(GetId) {
      this.itemSubcategoryid = GetId
      console.log('GetId', GetId)
      console.log('this.itemSubcategoryid', this.itemSubcategoryid)
      axios
        .delete(`${this.URL}/api/item/itemsubcategory/${this.itemSubcategoryid}`)
        .then(response => (this.ItemSubCategories = response.data.data))
      this.getItemSubCategories()
    },


    deleteData() {

      axios
        .delete(`${this.URL}/api/item/itemsubcategory/${this.itemSubcategoryid}`)
        .then(response => (this.ItemSubCategories = response.data.data))
      this.getItemSubCategories()
    },

    async Updates(Getdata) {

      this.itemSubcategoryid = Getdata
      this.name_edit = Getdata.name
      this.name_loc_edit = Getdata.name_loc
      this.color_edit = Getdata.color
      this.image_edit = Getdata.image
      this.dialogVisible=false

      console.log(Getdata)
    },

    async updateItemSubCategories() {
      try {
        const user = await axios.put(

          `${this.URL}/api/item/itemsubcategory/${this.itemSubcategoryid.id}`,
          {


            name: this.name_edit,
            name_loc: this.name_loc_edit,
            color_edit: this.color,
            image_edit: this.image,
    

          },

        )

        this.getItemSubCategories()
        this.dialogVisible = false
      
      } catch (e) {
        console.log(e)
      }

    },




  },
}
</script>


