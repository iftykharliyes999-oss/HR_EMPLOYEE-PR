<div class="row mb-4">

    <div class="col-md-3">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h6 class="text-muted">
                    Total Notifications
                </h6>

                <h3>
                    {{ $stats['total'] }}
                </h3>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h6 class="text-success">
                    Published
                </h6>

                <h3>
                    {{ $stats['published'] }}
                </h3>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h6 class="text-secondary">
                    Draft
                </h6>

                <h3>
                    {{ $stats['draft'] }}
                </h3>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h6 class="text-danger">
                    Urgent
                </h6>

                <h3>
                    {{ $stats['urgent'] }}
                </h3>

            </div>

        </div>

    </div>

</div>
