export type JobListing = {
    jobId: number;
    title: string;
    slug: string;
    employment: {
        name: string;
    }
}

export type JobListingResponse = {
    payload: null|Array<JobListing>
}
