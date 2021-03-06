<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\StoreFormSettingRequest;
use App\Http\Requests\UpdateFormSettingRequest;
use App\Models\FormSetting;
use App\Repositories\Contracts\FormSettingRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FormSettingController extends BackendController
{
    /**
     * @var FormSettingRepository
     */
    protected $formSettings;

    /**
     * Create a new controller instance.
     *
     * @param FormSettingRepository $formSettings
     */
    public function __construct(FormSettingRepository $formSettings)
    {
        $this->formSettings = $formSettings;
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            /** @var \Yajra\DataTables\EloquentDataTable $query */
            $query = DataTables::of($this->formSettings->select([
                'id',
                'name',
                'recipients',
                'created_at',
                'updated_at',
            ]));

            return $query->editColumn('name', function (FormSetting $formSetting) {
                return trans("forms.{$formSetting->name}.display_name");
            })->addColumn('actions', function (FormSetting $formSetting) {
                return $this->formSettings->getActionButtons($formSetting);
            })->editColumn('created_at', function (FormSetting $formSetting) use ($request) {
                return $formSetting->created_at->setTimezone($request->user()->timezone);
            })->editColumn('updated_at', function (FormSetting $formSetting) use ($request) {
                return $formSetting->updated_at->setTimezone($request->user()->timezone);
            })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }

    /**
     * @return array
     */
    public function getFormTypes()
    {
        $formTypes = collect(config('forms'));

        $formTypes->transform(function ($item) {
            return trans($item['display_name']);
        });

        return $formTypes;
    }

    /**
     * @param FormSetting $form_setting
     *
     * @return FormSetting
     */
    public function show(FormSetting $form_setting)
    {
        return $form_setting;
    }

    /**
     * @param StoreFormSettingRequest $request
     *
     * @return mixed
     */
    public function store(StoreFormSettingRequest $request)
    {
        $this->authorize('create form_settings');

        $this->formSettings->store($request->input());

        return $this->RedirectResponse($request, trans('alerts.backend.form_settings.created'));
    }

    /**
     * @param FormSetting              $formSetting
     * @param UpdateFormSettingRequest $request
     *
     * @return mixed
     */
    public function update(FormSetting $formSetting, UpdateFormSettingRequest $request)
    {
        $this->authorize('edit form_settings');

        $this->formSettings->update($formSetting, $request->input());

        return $this->RedirectResponse($request, trans('alerts.backend.form_settings.updated'));
    }

    /**
     * @param FormSetting $formSetting
     * @param Request     $request
     *
     * @return mixed
     */
    public function destroy(FormSetting $formSetting, Request $request)
    {
        $this->authorize('delete form_settings');

        $this->formSettings->destroy($formSetting);

        return $this->RedirectResponse($request, trans('alerts.backend.form_settings.deleted'));
    }
}
