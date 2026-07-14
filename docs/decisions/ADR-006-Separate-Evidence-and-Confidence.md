# ADR-006

## Title

Separate Evidence and Confidence

---

## Status

Accepted

---

## Date

2026-07-14

---

## Context

During the development of Pattern Theory and Evidence Theory, Evidence and Confidence were initially considered as a single concept.

Evidence was informally described as a measure of confidence in a Pattern.

However, further theoretical analysis revealed that these two concepts answer fundamentally different educational questions.

Evidence explains **why** a Pattern deserves trust.

Confidence estimates **how much** that Pattern should be trusted.

Treating them as the same concept reduced explainability and blurred architectural responsibilities.

---

## Decision

Evidence and Confidence are defined as two independent architectural layers.

Evidence is responsible for providing observable educational justification.

Confidence is responsible for estimating the strength of that justification.

Confidence always depends on Evidence.

Evidence never depends on Confidence.

---

## Rationale

Separating Evidence from Confidence improves both educational transparency and architectural clarity.

Educators should always be able to inspect the educational reasons supporting a Pattern before considering any confidence estimate.

This distinction also enables independent evolution of:

- Evidence Engine
- Confidence Framework

while preserving explainability.

---

## Consequences

The Educational Knowledge Model now includes a dedicated Confidence layer.

```
Educational Reality

↓

Observation

↓

Pattern

↓

Evidence

↓

Confidence

↓

Insight

↓

Understanding
```

Future implementations will estimate confidence only after sufficient Evidence has been established.

Insights will depend on both Evidence and Confidence.

---

## Alternatives Considered

### Alternative 1

Treat Evidence as a confidence score.

Rejected because observable justification and confidence estimation represent different educational responsibilities.

---

### Alternative 2

Merge Confidence into Insight.

Rejected because educational meaning should only be generated after confidence has already been established.

---

### Alternative 3

Remove Confidence completely.

Rejected because educators benefit from understanding not only *why* a Pattern is supported, but also *how strongly* it is supported.

---

## Related Documents

- EVIDENCE_THEORY.md
- INSIGHT_THEORY.md
- EDUCATIONAL_KNOWLEDGE_MODEL.md
- THEORY_REVIEW.md

---

## Notes

This decision introduced one of the most important architectural separations within SchoolOS.

Evidence answers:

> **Why should this Pattern be trusted?**

Confidence answers:

> **How much should this Pattern be trusted?**

Keeping these responsibilities separate preserves explainability throughout the Educational Knowledge Model.