<template>
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <div class="pull-right mt-2" v-if="this.$app.user.can('create form_settings')">
                    <router-link to="/form-settings/create" class="btn btn-success btn-sm"><i class="icon-plus"></i>
                        {{ $t('buttons.form_settings.create') }}
                    </router-link>
                </div>
                <h4 class="mt-1">{{ $t('labels.backend.form_settings.titles.index') }}</h4>
            </div>
            <div class="card-body">
                <datatable :options="dataTableOptions"></datatable>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'form_setting_list',
    data () {
      return {
        dataTableOptions: {
          responsive: true,
          serverSide: true,
          processing: true,
          autoWidth: false,
          lengthChange: false,
          searching: false,
          paging: false,
          info: false,
          buttons: [],
          ajax: {
            url: this.$app.route('admin.form_settings.search'),
            type: 'post'
          },
          columns: [{
            title: this.$i18n.t('validation.attributes.form_type'),
            data: 'name',
            name: 'name',
            width: 150,
            responsivePriority: 1
          }, {
            title: this.$i18n.t('validation.attributes.recipients'),
            data: 'recipients',
            name: 'recipients',
            orderable: false
          }, {
            title: this.$i18n.t('validation.attributes.message'),
            data: 'message',
            name: 'message',
            defaultContent: this.$i18n.t('labels.no_value'),
            orderable: false
          }, {
            title: this.$i18n.t('labels.created_at'),
            data: 'created_at',
            name: 'created_at',
            width: 110,
            className: 'text-center'
          }, {
            title: this.$i18n.t('labels.updated_at'),
            data: 'updated_at',
            name: 'updated_at',
            width: 110,
            className: 'text-center'
          }, {
            title: this.$i18n.t('labels.actions'),
            data: 'actions',
            name: 'actions',
            orderable: false,
            width: 75,
            className: 'nowrap',
            responsivePriority: 2
          }],
          order: [[0, 'asc']],
          rowId: 'id'
        }
      }
    }
  }
</script>
