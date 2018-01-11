{{--dd($users->toArray())--}}

@extends('layouts.admin')

@section('breadcrumb')
    {!! $breadcrumb->add(__('app.organizations'),'/admin/organizations')->add(__('app.assign_branches'))
        ->setTcrumb($organization->name)
        ->render() !!}
@stop

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('app.org_available') }}</h3>
                    </div>
                    {!!
                        $list->setModel($filialDis)
                            ->columns(['id','name'=>__('app.name'),'azioni'])
                            ->showActions(false)
                            ->showAll(false)
                            ->setPrefix('RTYX_')
                            ->customizes('azioni', function($row) use($organization) {
                                return "<a href=\"/admin/organizations/". $organization->id."/addFilial/".$row['id']."\" class=\"btn btn-warning btn-xs pull-right\">".__('app.assign')."</a>";
                            })->render()
                    !!}
                </div> <!-- /.box -->
            </div> <!-- /.col -->
            <div class="col-md-7">

                {!!
                    $composer->boxNavigator([
                        'type'=>'primary',
                        'title'=>$organization->id ." - ".$organization->name,
                        'listMenu'=>[
                            __('app.list_org')=>url('/admin/organizations'),
                            'divider'=>"divider",
                            __('app.update')=>url('/admin/organizations/edit',$organization->id),
                            __('app.assign_users')=>url('/admin/organizations/assignUser',$organization->id),
                            __('app.profile')=>url('/admin/organizations/profile',$organization->id),
                        ],
                        'urlNavPre'=>url('/admin/organizations/assignFilial',$pag['preid']->id),
                        'urlNavNex'=>url('/admin/organizations/assignFilial',$pag['nexid']->id),
                        ])->render()
                 !!}

                <div class="box box-default">
                    {!!
                         $list->setModel($filialAss)
                            ->columns(['id','name'=>__('app.name'),'azioni'])
                            ->showActions(false)
                            ->showAll(false)
                            ->setPrefix('HGYU_')
                            ->customizes('azioni', function($row) use($organization) {
                                return "<a href=\"/admin/organizations/removeFilial/".$row['id']."\" class=\"btn btn-danger btn-xs pull-right\">".__('app.delete')."</a>";
                            })->render()
                     !!}
                </div> <!-- /.box -->
            </div> <!-- /.col -->
        </div> <!-- /.row -->
    </section>
    <!-- /.content -->
@stop
@push('scripts')
    <script>
        $("#RTYX_xpage").change(function () {
            $("#RTYX_xpage-form").submit();
        });
        $("#HGYU_xpage").change(function () {
            $("#HGYU_xpage-form").submit();
        });
    </script>
@endpush