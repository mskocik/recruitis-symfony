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

export type FormField = {
    name: string;
    type: string;
    label: string;
    value: string|int|array|null;
    required: bool;
    options: Record<string, string>;
    hidden: bool;
    order: int;
}

export type FormDefinitionResponse = {
    fields: null|Array<FormField>
}