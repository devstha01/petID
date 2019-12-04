<?php

namespace App\Http\Controllers\Admin;

use App\Cloudsa9\Constants\AccountType;
use App\Cloudsa9\Constants\DeviceType;
use App\Cloudsa9\Constants\StatusType;
use App\Cloudsa9\Entities\Models\User\User;
use App\Domain\Admin\Requests\Subscriber\SubscriberCreateRequest;
use App\Domain\Admin\Requests\Subscriber\SubscriberRequest;
use App\Domain\Admin\Requests\Subscriber\SubscriberUpdateRequest;
use App\Domain\Admin\Services\Subscriber\AccountService;
use App\Domain\Admin\Services\Subscriber\ContactInfoService;
use App\Http\Controllers\Controller;
use Exception;
use Yajra\Datatables\Datatables;

class SubscribersController extends Controller
{
    /**
     * @var AccountService
     */
    private $accountService;
    /**
     * @var ContactInfoService
     */
    private $contactInfoService;

    /**
     * SubscribersController constructor.
     * @param AccountService $accountService
     * @param ContactInfoService $contactInfoService
     */
    public function __construct(AccountService $accountService, ContactInfoService $contactInfoService)
    {
        $this->accountService = $accountService;
        $this->contactInfoService = $contactInfoService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribers = $this->accountService->all();

        return view('admin.modules.subscriber.index', ['subscribers' => $subscribers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accountInfo = [];
        $contactInfo = [];
        $accountType = AccountType::all();
        $status = StatusType::all();
        $device = DeviceType::all();

        return view('admin.modules.subscriber.create', [
            'accountInfo' => $accountInfo,
            'contactInfo' => $contactInfo,
            'accountType' => $accountType,
            'status' => $status,
            'device' => $device
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SubscriberCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SubscriberCreateRequest $request)
    {
        try {
            $subscriber = $this->accountService->create($request->all());
            $this->contactInfoService->updateOrCreate(array_merge($request->all(), ['user_id' => $subscriber->id]));

            flash()->success('Subscriber successfully created.');
        } catch (Exception $e) {
            logger()->error($e);
            flash()->error('Unable to create subscriber.');
            return redirect()->back()->withInput();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accountInfo = $this->accountService->find($id);

        $contactInfo = $this->contactInfoService->findBySubscriber($accountInfo->id);
        $accountType = AccountType::all();
        $status = StatusType::all();

        return view('admin.modules.subscriber.edit', [
            'accountInfo' => $accountInfo,
            'contactInfo' => $contactInfo,
            'status' => $status,
            'accountType' => $accountType
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SubscriberUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SubscriberUpdateRequest $request, $id)
    {
        try {
            $this->accountService->update($request->all(), $id);
            $this->contactInfoService->updateOrCreate(array_merge($request->all(), ['id' => 'contact_info_id', 'user_id' => $id]));

            flash()->success('Subscriber successfully updated.');
        } catch (Exception $e) {
            logger()->error($e);
            flash()->error('Unable to update subscriber.');
        }

        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->accountService->delete($id);
//            $this->contactInfoService->delete($id);
            flash()->success('Subscriber successfully deleted.');
        } catch (Exception $e) {
            logger()->error($e);
            flash()->error('Unable to delete subscriber.');
        }

        return redirect()->back();
    }
}
