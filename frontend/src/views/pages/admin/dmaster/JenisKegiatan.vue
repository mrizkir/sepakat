<template>
  <AdminLayout>
    <ModuleHeader>
      <template v-slot:icon>
        mdi-format-list-bulleted-triangle
      </template>
      <template v-slot:name>
        JENIS KEGIATAN
      </template>
      <template v-slot:breadcrumbs>
        <v-breadcrumbs :items="breadcrumbs" class="pa-0">
          <template v-slot:divider>
            <v-icon>mdi-chevron-right</v-icon>
          </template>
        </v-breadcrumbs>
      </template>
      <template v-slot:desc>
        <v-alert color="cyan" border="left" colored-border type="info">
          Halaman untuk menampilkan daftar jenis-jenis kegiatan.
        </v-alert>
      </template>
    </ModuleHeader>
    <v-container fluid>
      <v-row class="mb-4" no-gutters>
        <v-col cols="12">
          <v-data-table
            :headers="headers"
            :items="datatable"
            item-key="id_jenis"
            sort-by="id_jenis"
            class="elevation-1"
            :disable-pagination="true"
            :hide-default-footer="true"
            :loading="datatableLoading"
            loading-text="Loading... Please wait">
            <template v-slot:top>
              <v-toolbar flat color="white">
                <v-toolbar-title>DAFTAR JENIS KEGIATAN</v-toolbar-title>
                <v-divider
                  class="mx-4"
                  inset
                  vertical
                ></v-divider>
                <v-spacer></v-spacer>
              </v-toolbar>
            </template>
            <template v-slot:expanded-item="{ headers, item }">
              <td :colspan="headers.length" class="text-center">
                <v-col cols="12">
                  <strong>ID:</strong>{{ item.idkelas }}
                </v-col>
              </td>
            </template>
            <template v-slot:no-data>
              Data belum tersedia
            </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-container>
  </AdminLayout>
</template>
<script>
  import { mapGetters } from 'vuex'
  import AdminLayout from '@/views/layouts/AdminLayout'
  import ModuleHeader from '@/components/ModuleHeader'
  export default {
    name: 'JenisKegiatan',
    created() {
      this.breadcrumbs = [
        {
          text: 'HOME',
          disabled: false,
          href: '/dashboard/' + this.ACCESS_TOKEN,
        },
        {
          text: 'DATA MASTER',
          disabled: false,
          href: '#',
        },
        {
          text: 'JENIS KEGIATAN',
          disabled: true,
          href: '#',
        }
      ]
      this.initialize()
    },
    data: () => ({
      btnLoading: false,
      datatableLoading: false,
      expanded: [],
      datatable: [],
      headers: [
        { text: 'ID JENIS', value: 'id_jenis', width: 150 },
        { text: 'NAMA JENIS', value: 'nama_jenis' },
      ],
    }),
    methods: {
      initialize: async function() {
        this.datatableLoading = true
        await this.$ajax
          .get('/datamaster/jeniskegiatan', {
            headers: {
              Authorization: this.TOKEN,
            },
          })
          .then(({ data }) => {
            this.datatable = data.jenis_kegiatan
            this.datatableLoading = false
          })
          .catch(() => {
            this.datatableLoading = false
          })
      },
      dataTableRowClicked(item) {
        if (item === this.expanded[0]) {
          this.expanded = []
        } else {
          this.expanded = [item]
        }
      },
    },
    computed: {
      ...mapGetters('auth', {
        ACCESS_TOKEN: 'AccessToken',
        TOKEN: 'Token',
      }),
      formTitle() {
        return this.editedIndex === -1 ? 'TAMBAH DATA' : 'UBAH DATA'
      },
    },
    components: {
      AdminLayout,
      ModuleHeader,
    },
  }
</script>
