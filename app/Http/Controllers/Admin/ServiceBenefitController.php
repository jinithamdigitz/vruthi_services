<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceBenefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ServiceBenefitController extends Controller
{
    /**
     * Store benefits for a service (from service form)
     */
    public function store(Request $request, Service $service)
    {
        $request->validate([
            'benefit_title' => 'nullable|array',
            'benefit_title.*' => 'nullable|string|max:255',
            'benefit_image' => 'nullable|array',
            'benefit_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'benefit_status' => 'nullable|array',
            'benefit_status.*' => 'nullable|boolean'
        ]);

        // Delete existing benefits if updating
        if ($request->has('_method') && $request->_method == 'PUT') {
            // Delete old images
            $oldBenefits = $service->benefits;
            foreach ($oldBenefits as $oldBenefit) {
                if ($oldBenefit->image && file_exists(public_path('uploads/' . $oldBenefit->image))) {
                    File::delete(public_path('uploads/' . $oldBenefit->image));
                }
                $oldBenefit->delete();
            }
        }

        // Store new benefits
        if ($request->has('benefit_title')) {
            $titles = $request->benefit_title;
            $statuses = $request->benefit_status ?? [];
            $images = $request->file('benefit_image') ?? [];

            foreach ($titles as $index => $title) {
                if (!empty($title)) {
                    $benefit = new ServiceBenefit();
                    $benefit->service_id = $service->id;
                    $benefit->title = $title;
                    $benefit->is_active = isset($statuses[$index]) ? (bool)$statuses[$index] : true;

                    // Handle image upload
                    if (isset($images[$index])) {
                        $image = $images[$index];
                        $imageName = time() . '_benefit_' . $index . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('uploads'), $imageName);
                        $benefit->image = $imageName;
                    }

                    $benefit->save();
                }
            }
        }

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service benefits saved successfully!');
    }

    /**
     * Get benefits for a service (AJAX)
     */
    public function getBenefits(Service $service)
    {
        $benefits = $service->benefits;
        return response()->json($benefits);
    }

    /**
     * Delete a single benefit
     */
    public function destroy(Service $service, ServiceBenefit $benefit)
    {
        if ($benefit->service_id !== $service->id) {
            abort(404);
        }

        // Delete image if exists
        if ($benefit->image && file_exists(public_path('uploads/' . $benefit->image))) {
            File::delete(public_path('uploads/' . $benefit->image));
        }

        $benefit->delete();

        return response()->json(['success' => 'Benefit deleted successfully!']);
    }

    /**
     * Toggle benefit status (active/inactive)
     */
    public function toggleStatus(Service $service, ServiceBenefit $benefit)
    {
        if ($benefit->service_id !== $service->id) {
            abort(404);
        }

        $benefit->update(['is_active' => !$benefit->is_active]);

        return response()->json([
            'success' => 'Benefit status updated successfully!',
            'is_active' => $benefit->is_active
        ]);
    }

    /**
     * Update benefit order (for drag-and-drop)
     */
    public function updateOrder(Request $request, Service $service)
    {
        $request->validate([
            'benefits' => 'required|array',
            'benefits.*' => 'required|integer|exists:service_benefits,id'
        ]);

        foreach ($request->benefits as $index => $benefitId) {
            ServiceBenefit::where('id', $benefitId)
                ->where('service_id', $service->id)
                ->update(['display_order' => $index]);
        }

        return response()->json(['success' => 'Order updated successfully']);
    }
}