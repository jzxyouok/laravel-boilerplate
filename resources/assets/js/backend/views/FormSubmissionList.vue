<template>
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <h4>{{ $t('labels.backend.form_submissions.titles.index') }}</h4>
            </div>
            <div class="card-body">
                <datatable :options="dataTableOptions" :actions="dataTableActions" action-route-name="admin.form_submissions.batch_action"></datatable>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'form_submission_list',
    data () {
      return {
        dataTableOptions: {
          responsive: true,
          serverSide: true,
          processing: true,
          ajax: {
            url: this.$app.route('admin.form_submissions.search'),
            type: 'post'
          },
          columns: [{
            defaultContent: '',
            title: '',
            data: 'checkbox',
            name: 'checkbox',
            orderable: false,
            searchable: false,
            width: 15,
            className: 'select-checkbox'
          }, {
            title: this.$i18n.t('validation.attributes.form_type'),
            data: 'type',
            name: 'type',
            width: 150,
            responsivePriority: 1
          }, {
            title: this.$i18n.t('validation.attributes.form_data'),
            data: 'data',
            name: 'data',
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
          select: {style: 'os'},
          order: [[3, 'desc']],
          rowId: 'id'
        },
        dataTableActions: {
          destroy: this.$i18n.t('labels.backend.form_submissions.actions.destroy')
        }
      }
    }
  }
</script>
