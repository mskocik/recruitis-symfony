<?php declare(strict_types=1);

namespace App\Tests\Helpers;

use Symfony\Component\HttpClient\Response\MockResponse;

class TestData
{
    /**
     * Returns paired data, http_status
     * 
     * @return array{0: string, 1: int}
     */
    public static function validJobListing(): array
    {
        return [
            '{"payload":[{"job_id":431912,"secured_id":"6D65xKemuldGqfr6xRMq1UtMcmNURQr3","draft":false,"active":true,"access_state":1,"public_id":null,"title":"Manažer segmentu trhu ve Fiber tribu KLON LHO 17;test","description":"<p><strong>Téčko tedy T-Mobile a Slovak Telekom","internal_note|string":null,"date_end":null,"date_closed":null,"closed_duration":null,"date_created":"2023-06-30 09:28:00","date_created_origin":"2023-06-30 09:28:00","last_update":"2023-06-30 09:44:15","text_language":"cs","workfields":[{"id":2516,"name":"Vedoucí prodejny/provozu"},{"id":3704,"name":"Marketingový ředitel"}],"filterlist":[{"id":1829,"name":"CZweb","group":"Kariérní web","group_id":334},{"id":1839,"name":"TM_centrala","group":"Photo Gallery","group_id":335},{"id":1843,"name":"DNA Hunter Plus","group":"Referral program","group_id":336},{"id":2175,"name":"Administration","group":"Team","group_id":388}],"education":{"id":-1,"name":"Vzdělání není podstatné"},"disability":null,"details":{"office_id":3432662,"facebook_picture_path":null,"opening_reason":null,"suitable_for":[{"id":1,"name":"Absolventi"},{"id":2,"name":"Důchodci"},{"id":3,"name":"Na rodičovské dovolené"},{"id":4,"name":"Nezaměstnaní"},{"id":5,"name":"NVS, ZVS"},{"id":6,"name":"OSVČ (práce na IČO)"},{"id":7,"name":"Studenti"},{"id":8,"name":"Zaměstnaní"},{"id":10,"name":"Není vhodná pro absolventy"},{"id":11,"name":"Uprchlíci z Ukrajiny"}],"remote_work":null,"driving_license":null,"video_link":null,"video_link_name":null},"personalist":{"id":27015,"name":"Aleš Bednář","initials":"AB"},"contact":{"name":"Lukáš Hanko","initials":"LH","email":"mlynarcikova.simona@gmail.com","phone":null,"employee":{"id":27050,"name":"Lukáš","surname":"Hanko","initials":"LH","email":"lukas.hanko2@t-mobile.cz","photo_url":"https://app.recruitis.io/image/h/cExNTDJlTEFLSUlYR01haTgyZGlzemdEN3Y2RGU0b3NIbEJIKy9FMERrV0s5MlIwRTYveklGU1UxbTF0aCsreQ==?focus=center&imprint=c81dc2542c94fe77211f1d655ad6f5e0","phone":"+421 123 456 789","linkedin":"https://www.linkedin.com/in/lukashlukash/"}},"sharing":[],"addresses":[{"id":3452167,"office_id":3432662,"city":"Praha 11","postcode":"14800","street":"Tomíčkova 2144/1","region":"Hlavní město Praha","state":"CZ","is_primary":true}],"employment":{"id":1,"name":"Práce na zkrácený úvazek"},"confidential":false,"salary":{"min":0,"max":35709,"currency":"CZK","unit":"month","visible":false,"note":null,"is_min_visible":false,"is_max_visible":false,"is_range":false},"salary_default_currency":"CZK","channels":{"portal":{"id":2,"name":"Inzerní portály","date_end":false,"date_from":false,"active":false,"paused":false,"date_assigned":false,"visible_for_everyone":true},"company_page":{"id":3,"name":"Firemní stránky","date_end":false,"date_from":false,"active":false,"paused":false,"date_assigned":false,"visible_for_everyone":true},"company_page_internal_offers":{"id":10,"name":"Firemní stránky pro interní pozice","date_end":false,"date_from":false,"active":false,"paused":false,"date_assigned":false,"visible_for_everyone":true},"intranet":{"id":4,"name":"Intranet","date_end":false,"date_from":false,"active":false,"paused":false,"date_assigned":false,"visible_for_everyone":true},"internal":{"id":1,"name":"Interní pozice","date_end":false,"date_from":false,"date_assigned":"2023-07-30 00:00:02","paused":false,"active":true,"visible_for_everyone":true},"czechcrunch":{"id":8,"name":"Czechcrunch","date_end":false,"date_from":false,"active":false,"paused":false,"date_assigned":false,"visible_for_everyone":true},"profesia":{"id":9,"name":"Profesia API","date_end":false,"date_from":false,"active":false,"paused":false,"date_assigned":false,"visible_for_everyone":true},"ejobs":{"id":11,"name":"eJobs","date_end":false,"date_from":false,"active":false,"paused":false,"date_assigned":false,"visible_for_everyone":true},"expats":{"id":12,"name":"expats.cz","date_end":false,"date_from":false,"active":false,"paused":false,"date_assigned":false,"visible_for_everyone":true},"indeed":{"id":13,"name":"Portál Indeed","date_end":false,"date_from":false,"active":false,"paused":false,"date_assigned":false,"visible_for_everyone":true},"moje_delo":{"id":14,"name":"MojeDelo.com","date_end":false,"date_from":false,"active":false,"paused":false,"date_assigned":false,"visible_for_everyone":true}},"edit_link":"https://app.recruitis.io/zadavatel/editor/create/id/431912","public_link":"https://jobs.recruitis.io/testovaciucetpr/431912-manazer-segmentu-trhu-ve-fiber-tribu-klon-lho-17-m-z-test-test-m-z-test-test","preview_url":"https://jobs.recruitis.io/testovaciucetpr/431912-manazer-segmentu-trhu-ve-fiber-tribu-klon-lho-17-m-z-test-test-m-z-test-test-6D65xKemuldGqfr6xRMq1UtMcmNURQr3","referrals":[]}],"meta":{"code":"api.found","duration":150,"message":"Jobs are returned.","entries_from":1,"entries_to":10,"entries_total":62,"entries_sum":10}}'
            ,200
        ];
    }

    /**
     * Returns paired data, http_status
     * 
     * @return array{0: string, 1: int}
     */
    public static function unauthorizedJobListing(): array
    {
        return ['{"payload":null,"meta":{"message":"Authorization failed: token not found.","code":"api.error.unauthorized","duration":10}}', 401];
    }

    /**
     * @return array<array<MockResponse>>
     */
    public static function getListingTestCases(): array
    {
        $cases = [
            static::validJobListing(),
            static::unauthorizedJobListing()
        ];
        $dataset = [];

        foreach($cases as [$data, $status]) {
            $datasetEntry = [];
            $datasetEntry[] = new MockResponse($data, [ 'http_code' => $status ]);
            $dataset[] = $datasetEntry;
        }

        return $dataset;
    }
}