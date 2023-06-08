<template lang="">
    <div class="table-responsive">

        <dv class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6>Total Sites</h6>
                        <h4>{{ reports.length }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6>Total Delivered</h6>
                        <h4>{{ delivered_count }}</h4>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6>Total Installed</h6>
                        <h4>{{ installation_count}}</h4>

                    </div>
                </div>
            </div>
        </dv>

        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>LGA</th>
                    <th>LOCATION</th>

                    <th>DELIVERY STATUS</th>

                    <th>INSTALLATION STATUS</th>


                    <th>COMPLETION</th>

                </tr>
            </thead>
            <tbody>
                <tr v-for="report, key in reports" :key="report.id">
                    <td>{{ key + 1 }}</td>
                    <td>{{ report.lga }}</td>

                    <td>{{ report.location }}</td>

                    <td >
                        <div class="form-check form-switch" >
                            <input  class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                            @click=updateDeliveryStatus(report.id)
                                :checked="report.delivery_status ==='delivered' ? true : false">
                            <label class="form-check-label" for="flexSwitchCheckChecked" > {{ report.delivery_status
                            }}</label>
                        </div>
                    </td>


                    <td>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                                @click=updateInstallationStatus(report.id)
                                :checked="report.installation_status == 'installed' ? true : false">
                            <label class="form-check-label" for="flexSwitchCheckChecked"> {{ report.installation_status
                            }}</label>
                        </div>

                    </td>

                    <td>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" :style="'width:' + report.percent_completion + '%;'"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> {{ report.percent_completion }}%
                            </div>
                        </div>
                    </td>


                </tr>

            </tbody>
        </table>





    </div>
</template>
<script>
export default {

    data() {
        return {
            reports: [],
            dstatus: 'delivery',
            istatus: 'installation',
            delivered_count: 0,
            installation_count: 0
        }
    },

    props: ['appurl', 'userid', 'project_id'],

    methods: {
        getReports() {
            axios({

                url: this.appurl + 'api/project-reports',
                method: 'get',
                params: {
                    project_id: 2
                }


            }).then((resp) => {

                this.reports = resp.data.reports
                this.delivered_count = resp.data.delivered_count
                this.installation_count = resp.data.installation_count

                console.log(resp)

            }).catch((res) => {
                console.log(res)
            });
        },

        updateDeliveryStatus(id) {

            axios({

                url: this.appurl + 'api/update-report-line',
                method: 'post',
                params: {
                    project_id: 2,
                    report_type: 'delivery',
                    id: id
                }


            }).then((resp) => {



                alert('updated')

                this.getReports()

                console.log(resp)

            }).catch((res) => {
                console.log(res)
            });

        },

        updateInstallationStatus(id) {

            axios({

                url: this.appurl + 'api/update-report-line',
                method: 'post',
                params: {
                    project_id: 2,
                    report_type: 'installation',
                    id: id
                }


            }).then((resp) => {



                alert('updated')

                this.getReports()


                console.log(resp)

            }).catch((res) => {
                console.log(res)
            });

        }
    },

    mounted() {
        this.getReports()
    },

}
</script>
