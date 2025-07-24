<?php

namespace App\Services;

use App\Models\Coupon;
use App\Models\Course;

class CouponService
{
    /**
     * Appliquer un coupon à un montant
     */
    public function applyCoupon(string $couponName, float $amount, ?int $courseId = null, ?int $instructorId = null): array
    {
        $coupon = Coupon::where('coupon_name', $couponName)->first();

        if (!$coupon) {
            return [
                'success' => false,
                'message' => 'Coupon non trouvé',
                'original_amount' => $amount,
                'discount_amount' => 0,
                'final_amount' => $amount
            ];
        }

        if (!$coupon->isValid()) {
            return [
                'success' => false,
                'message' => 'Coupon expiré ou inactif',
                'original_amount' => $amount,
                'discount_amount' => 0,
                'final_amount' => $amount
            ];
        }

        // Vérifier si le coupon est applicable
        if (!$this->isCouponApplicable($coupon, $courseId, $instructorId)) {
            return [
                'success' => false,
                'message' => 'Coupon non applicable',
                'original_amount' => $amount,
                'discount_amount' => 0,
                'final_amount' => $amount
            ];
        }

        $discountAmount = $coupon->calculateDiscount($amount);
        $finalAmount = max(0, $amount - $discountAmount); // Ne peut pas être négatif

        return [
            'success' => true,
            'message' => 'Coupon appliqué avec succès',
            'original_amount' => $amount,
            'discount_amount' => $discountAmount,
            'final_amount' => $finalAmount,
            'coupon' => $coupon
        ];
    }

    /**
     * Vérifier si le coupon est applicable
     */
    private function isCouponApplicable(Coupon $coupon, ?int $courseId = null, ?int $instructorId = null): bool
    {
        // Coupon global
        if ($coupon->isGlobal()) {
            return true;
        }

        // Coupon spécifique à un cours
        if ($coupon->course_id && $courseId && $coupon->course_id == $courseId) {
            return true;
        }

        // Coupon spécifique à un instructeur
        if ($coupon->instructor_id && $instructorId && $coupon->instructor_id == $instructorId) {
            return true;
        }

        // Vérifier si le cours appartient à l'instructeur du coupon
        if ($coupon->instructor_id && $courseId) {
            $course = Course::find($courseId);
            if ($course && $course->instructor_id == $coupon->instructor_id) {
                return true;
            }
        }

        return false;
    }

    /**
     * Obtenir tous les coupons valides pour un cours/instructeur
     */
    public function getValidCoupons(?int $courseId = null, ?int $instructorId = null)
    {
        $query = Coupon::where('status', 1)
            ->where('coupon_validity', '>', now());

        // Coupons globaux ou spécifiques
        $query->where(function ($q) use ($courseId, $instructorId) {
            // Coupons globaux
            $q->where(function ($subQ) {
                $subQ->whereNull('course_id')->whereNull('instructor_id');
            });

            // Coupons spécifiques au cours
            if ($courseId) {
                $q->orWhere('course_id', $courseId);
            }

            // Coupons spécifiques à l'instructeur
            if ($instructorId) {
                $q->orWhere('instructor_id', $instructorId);
            }
        });

        return $query->get();
    }
}
