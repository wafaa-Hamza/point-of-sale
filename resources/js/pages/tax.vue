
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
                  Create New Tax
                </VBtn>
              </template>
              <VCard>
                <VCardTitle>
                  <span class="text-h5">Taxes</span>
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
                          v-model="per"
                          label="Per"
                        />

                        <VTextField
                          v-model="amount"
                          label="Amount"
                        />
                        <VTextField
                          v-model="formula"
                          label="Formula"
                        />
                        <VTextField
                          v-model="extra"
                          label="Extra"
                        />
                        <VTextField
                          v-model="accept_per"
                          label="Accept_Per"
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
                    @click="addTax"
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
                Per
              </th>
              <th>
                Amount
              </th>
              <th>
                Formula
              </th>
              <th>
                Extra
              </th>
              <th>
                Accept_Per
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
            <tr v-if="Taxes == null">
              <td
                colspan="8"
                style="text-align: center;"
              >
                No data available
              </td>
            </tr>
            <tr
              v-for="item in Taxes"
              v-else
              :key="item.id"
            >
              <td>{{ item.name }}</td>
              <td>{{ item.name_loc }}</td>
              <td>{{ item.per }}</td>
              <td>{{ item.amount }}</td>
              <td>{{ item.formula }}</td>
              <td>{{ item.extra }}</td>
              <td>{{ item.accept_per }}</td>



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
                        <span class="text-h5">taxes</span>
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
                                v-model="per_edit"
                                label="Per"
                              />

                              <VTextField
                                v-model="amount_edit"
                                label="Amount"
                              />
                              <VTextField
                                v-model="formula_edit"
                                label="Formula"
                              />
                              <VTextField
                                v-model="extra_edit"
                                label="Extra"
                              />
                              <VTextField
                                v-model="accept_per_edit"
                                label="Accept_Per"
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
                          @click=" updateTaxes(item)"
                        >
                          Update
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
  name: "TaxesTable",

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
      taxes: [],
      taxid: '',
      id: '',
      perPage: 10,
      
      pos_id: '',
      name: '',
      name_loc: '',
      per: '',
      amount: '',
      formula: '',
      extra: '',
      accept_per: '',


      count: 0,

      pagei: [],
      page: 2,
      pageInfo: null,
      totalPages: 4,
      pageSize: 5,

      pageSizes: [5, 10, 15, 20, 25, 30],


      name_edit: '',
      name_loc_edit: '',
      per_edit: '',
      amount_edit: '',
      formula_edit: '',
      extra_edit: '',
      accept_per_edit: '',
      dialogVisible: false,

      URL: window.location.origin,


    }
  },
  // eslint-disable-next-line vue/component-api-style
  mounted() {
    this.getTaxes()
  },

 


  // eslint-disable-next-line vue/component-api-style
  methods: {

    getTaxes() {
      axios
        .get(`${this.URL}/api/payment/tax`)
        .then(res => {

          this.taes = res.data.data

        })
    },
    async createTaxes() {
      response = await this.addTaxes()
    
      if (response.status != undefined) {
        this.alert('Tax has been created successfully', true)

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


   
   

    

    async addTaxes() {

      try {
        const user = await axios.post(
          `${this.URL}/api/payment/tax`,
          {
          
            pos_id: 1,
            name: this.name,
            name_loc: this.name_loc,
            per: this.per,
            amount: this.amount,
            formula: this.formula,
            extra: this.extra,
            accept_per: this.amount,
     
          },
        )

        this.name = ''
        this.name_loc = ''
        this.per = ''
        this.amount = ''
        this.formula = ''
        this.extra = ''
        this.accept_per = ''
  

        this.dialog = false


        this.getTaxes()
       
      } catch (e) {
        console.log(e)
      }
    },

    async Delete(GetId) {
      this.taxid = GetId
      console.log('GetId', GetId)
      console.log('this.taxid', this.taxid)
      axios
        .delete(`${this.URL}/api/payment/tax/${this.taxid}`)
        .then(response => (this.taxes = response.data.data))
      this.getTaxes()
    },


    deleteData() {

      axios
        .delete(`${this.URL}/api/payment/tax/${this.taxid}`)
        .then(response => (this.taxes = response.data.data))
      this.getTaxes()
    },

    async Updates(Getdata) {

      this.taxid = Getdata
      this.name_edit = Getdata.name
      this.name_loc_edit = Getdata.name_loc
      this. per_edit =GetData.per
      this. amount_edit =GetData.amount
      this.formula_edit =GetData.formula
      this. extra_edit =GetData.extra
      this. accept_per_edit =GetData.accept_per
      this.dialogVisible=true

      console.log(Getdata)
    },

    async updateTaxes() {
      try {
        const user = await axios.put(

          `${this.URL}/api/payment/tax/${this.taxid.id}`,
          {


            name: this.name_edit,
            name_loc: this.name_loc_edit,
            per: this. per_edit,
            amount: this. amount_edit,
            formula: this.formula_edit,
            extra: this. extra_edit,
            accept_per: this. accept_per_edit,
    

          },

        )

        this.getTaxes()
        this.dialogVisible = false
      
      } catch (e) {
        console.log(e)
      }

    },




  },
}
</script>


