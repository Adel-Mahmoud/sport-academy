<?php

namespace App\Domains\Subscriptions\Controllers\Admin;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Domains\Subscriptions\Requests\StoreSubscriptionRequest;
use App\Domains\Subscriptions\Requests\UpdateSubscriptionRequest;
use App\Domains\Subscriptions\UseCases\GetSubscriptionUseCase;
use App\Domains\Subscriptions\UseCases\RegisterSubscriptionUseCase;
use App\Domains\Subscriptions\UseCases\UpdateSubscriptionUseCase;

class SubscriptionController extends Controller
{
    public $titlePage = 'Subscriptions';
    public $sectionPage = 'Subscriptions';

    public function index(): View
    {
        $titlePage = $this->titlePage;
        return view('subscriptions::admin.index', compact('titlePage'));
    }

    public function create(): View
    {
        $titlePage = 'إضافة ' . $this->titlePage . ' جديد';
        $sectionPage = $this->sectionPage;
        return view('subscriptions::admin.create', compact('sectionPage', 'titlePage'));
    }

    public function store(
        StoreSubscriptionRequest $request,
        RegisterSubscriptionUseCase $useCase
    ) {
        $useCase->execute($request->validated());

        return redirect()
            ->route('admin.subscriptions.index')
            ->with('swal', [
                'type' => 'success',
                'title' => 'تم الإضافة!',
                'text' => 'تمت إضافة البيانات بنجاح.',
            ]);
    }

    public function edit(
        int $id,
        GetSubscriptionUseCase $useCase
    ): View {
        $subscription = $useCase->execute($id);
        $titlePage = 'تعديل ' . $this->titlePage;
        $sectionPage = $this->sectionPage;
        return view('subscriptions::admin.edit', compact('subscription', 'sectionPage', 'titlePage'));
    }

    public function update(
        UpdateSubscriptionRequest $request,
        int $id,
        UpdateSubscriptionUseCase $useCase
    ) {
        $useCase->execute($id, $request->validated());

        return redirect()
            ->route('admin.subscriptions.index')
            ->with('swal', [
                'type' => 'success',
                'title' => 'تم التعديل!',
                'text' => 'تم تعديل البيانات بنجاح.',
            ]);
    }
}