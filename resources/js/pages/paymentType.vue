
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
                  Create New PaymentType
                </VBtn>
              </template>
              <VCard>
                <VCardTitle>
                  <span class="text-h5">PaymentTypes</span>
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
                          v-model="type"
                          label="Type"
                        />

                        <VTextField
                          v-model="gl_account"
                          label="GL_account"
                        />
                        <VTextField
                          v-model="is_cash"
                          label="Is_cash"
                        />
                        <VTextField
                          v-model="active"
                          label="Active"
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
                    @click="addPaymentType"
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
                Type
              </th>
              <th>
                GL_account
              </th>
              <th>
                Is_cash
              </th>
              <th>
                Active
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
            <tr v-if="PaymentTypes == null">
              <td
                colspan="8"
                style="text-align: center;"
              >
                No data available
              </td>
            </tr>
            <tr
              v-for="item in PaymentTypes"
              v-else
              :key="item.id"
            >
              <td>{{ item.name }}</td>
              <td>{{ item.name_loc }}</td>
              <td>{{ item.type }}</td>
              <td>{{ item.gl_account }}</td>
              <td>{{ item.is_cash }}</td>
              <td>{{ item.active }}</td>



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
                        <span class="text-h5">PaymentTypes</span>
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
                                v-model="type_edit"
                                label="Type"
                              />

                              <VTextField
                                v-model="gl_account_edit"
                                label="GL_account"
                              />
                              <VTextField
                                v-model="is_cash_edit"
                                label="Is_cash"
                              />
                              <VTextField
                                v-model="active_edit"
                                label="Active"
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
                          @click=" updatePaymentTypes(item)"
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
  name: " PaymentTypesTable",

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
      PaymentTypes: [],
      paymenttypeid: '',
      id: '',
      perPage: 10,
      
      payment_mode_id: '',
      fo_pay_id: '',
      name: '',
      name_loc: '',
      type: '',
      gl_account: '',
      is_cash: '',
      active: '',


      count: 0,

      pagei: [],
      page: 2,
      pageInfo: null,
      totalPages: 4,
      pageSize: 5,

      pageSizes: [5, 10, 15, 20, 25, 30],


      name_edit: '',
      name_loc_edit: '',
      gl_account_edit: '',
      type_edit: '',
      is_cash_edit: '',
      active_edit: '',
      
      dialogVisible: false,

      URL: window.location.origin,


    }
  },
  // eslint-disable-next-line vue/component-api-style
  mounted() {
    this.getPaymentTypes()
  },

 


  // eslint-disable-next-line vue/component-api-style
  methods: {

    getPaymentTypes() {
      axios
        .get(`${this.URL}/api/payment/payment-type`)
        .then(res => {

          this.PaymentTypes = res.data.data

        })
    },
    async createPaymentTypes() {
      response = await this.addPaymentType()
    
      if (response.status != undefined) {
        this.alert('PaymentType has been created successfully', true)

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


   
   

    

    async addPaymentType() {

      try {
        const user = await axios.post(
          `${this.URL}/api/payment/payment-type`,
          {
          
            payment_mode_id: 4,
            fo_pay_id: this.fo_pay_id,
            name: this.name,
            name_loc: this.name_loc,
            type: this.type,
            gl_account: this.gl_account,
            is_cash: this.is_cash,
            active: this.active,
            
     
          },
        )

        this.name = ''
        this.name_loc = ''
        this.type = ''
        this.gl_account = ''
        this.is_cash = ''
        this.active = ''
       
       
  

        this.dialog = false


        this.getPaymentTypes()
       
      } catch (e) {
        console.log(e)
      }
    },

    async Delete(GetId) {
      this.paymenttypeid = GetId
      console.log('GetId', GetId)
      console.log('this.paymenttypeid', this.paymenttypeid)
      axios
        .delete(`${this.URL}/api/payment/payment-type/${this.paymenttypeid}`)
        .then(response => (this.PaymentTypes = response.data.data))
      this.getPaymentTypes()
    },


    deleteData() {

      axios
        .delete(`${this.URL}/api/payment/payment-type/${this.paymenttypeid}`)
        .then(response => (this.PaymentTypes = response.data.data))
      this.getPaymentTypes()
    },

    async Updates(Getdata) {

      this.paymenttypeid = Getdata
      this.name_edit = Getdata.name
      this.name_loc_edit = Getdata.name_loc
      this.type_edit = Getdata.type
      this.gl_account_edit = Getdata.gl_account
      this.is_cash_edit = Getdata.is_cash
      this.active_edit = Getdata.active
      this.dialogVisible=true

      console.log(Getdata)
    },

    async updatePaymentTypes() {
      try {
        const user = await axios.put(

          `${this.URL}/api/payment/payment-type/${this.paymenttypeid.id}`,
          {


            name: this.name_edit,
            name_loc: this.name_loc_edit,
            type_edit: this.type,
            gl_account_edit: this.gl_account,
            is_cash: this.is_cash,
            active: this.active,
    

          },

        )

        this.getPaymentTypes()
        this.dialogVisible = false
      
      } catch (e) {
        console.log(e)
      }

    },




  },
}
</script>


